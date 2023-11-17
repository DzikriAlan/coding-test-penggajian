<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use App\User;
use App\MstDataPegawai;
use App\MstDataJabatan;
use DB;

class MstDataPegawaiController extends Controller
{
  const ITEM_PER_PAGE = 10;
    /**
    * Menampilkan halaman Data Pegawai 
    *
    * 
    * @return \Illuminate\View\View
    */
    public function index(Request $request)
    {
      $searchParams = $request->all();
      $search = Arr::get($searchParams, 'search', '');
      $query = MstDataPegawai::query();
      $pegawaiQuery = $query
        ->leftJoin('users as a', 'a.id', '=', 'mst_data_pegawai.user_id')
        ->leftJoin('mst_data_jabatan as b', 'b.id', '=', 'mst_data_pegawai.jabatan_id')
        ->orWhere('b.nama_jabatan', 'LIKE', '%' . $search . '%')
        ->orWhere('nik', 'LIKE', '%' . $search . '%')
        ->orWhere('nama_pegawai', 'LIKE', '%' . $search . '%')
        ->orWhere('jenis_kelamin', 'LIKE', '%' . $search . '%')
        ->orWhere('status', 'LIKE', '%' . $search . '%')
        ->orWhere('hak_akses', 'LIKE', '%' . $search . '%')
        ->select('mst_data_pegawai.*', 'a.email', 'b.nama_jabatan')
        ->get();

      return response()->json(['status' => 'Success', 'data' => $pegawaiQuery], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jabatan_id' => 'required',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required',
            'nama_pegawai' => 'required|string',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'hak_akses' => 'required',
        ]);

        $input = $request->all();

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $input['nama_pegawai'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            $pegawai = MstDataPegawai::create([
                'nama_pegawai' => $input['nama_pegawai'],
                'user_id' => $user->id,
                'jabatan_id' => $input['jabatan_id'],
                'email' => $input['email'],
                'nik' => $input['nik'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'hak_akses' => $input['hak_akses'],
                'status' => $input['status'],
            ]);

            DB::commit();
            return response()->json(['status' => 'success', 'data' => $pegawai], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e], 400);
        }
    }

    public function show($id){
        try{
            $pegawai = MstDataPegawai::find($id);
            $user = User::find($pegawai->user_id);
            $jabatan = MstDataJabatan::find($pegawai->jabatan_id);
            $pegawai['jabatan'] = $jabatan->nama_jabatan;
            $pegawai['email'] = $user->email;
            $pegawai['password'] = $user->password;

            return response()->json(['status' => 'success', 'data' => $pegawai], 200);
        } catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e], 400);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'jabatan_id' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required',
            'nama_pegawai' => 'required|string',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'hak_akses' => 'required',
        ]);

        $input = $request->all();

        $pegawai = MstDataPegawai::find($id);
        $pegawai->jabatan_id = $input['jabatan_id'];
        $pegawai->nama_pegawai = $input['nama_pegawai'];
        $pegawai->nik = $input['nik'];
        $pegawai->jenis_kelamin = $input['jenis_kelamin'];
        $pegawai->status = $input['status'];
        $pegawai->hak_akses = $input['hak_akses'];
        $pegawai->save();

        $user = User::find($pegawai->user_id);
        $user->email = $input['email'];
        $user->name = $input['nama_pegawai'];
        $user->save();

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $pegawai = MstDataPegawai::find($id);
        if($pegawai == null){
            return response()->json(['status' => 'error', 'message' => 'Pegawai tidak ditemukan!'], 422);
        }

        $pegawai->delete();
        return response()->json(['status' => 'success'], 200);
    }
}