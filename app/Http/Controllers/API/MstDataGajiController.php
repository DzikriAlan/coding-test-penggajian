<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use App\MstDataPegawai;
use App\MstDataPotonganGaji;
use App\MstDataGaji;
use DB;

class MstDataGajiController extends Controller
{
    const ITEM_PER_PAGE = 10;
    /**
    * Menampilkan halaman Data Gaji 
    *
    * 
    * @return \Illuminate\View\View
    */
    public function index(Request $request)
    {
      $searchParams = $request->all();
      $search = Arr::get($searchParams, 'search', '');
      $potongan = MstDataPotonganGaji::sum('jml_potongan');
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
        ->select('mst_data_pegawai.*', 'a.email', 'b.*', 
            DB::raw("FORMAT((b.gaji_pokok), 0, 'id_ID') as gaji_pokok"),
            DB::raw("FORMAT((b.tj_transport), 0, 'id_ID') as tj_transport"),
            DB::raw("FORMAT((b.uang_makan), 0, 'id_ID') as uang_makan"),
            DB::raw("FORMAT((b.gaji_pokok + b.tj_transport + b.uang_makan), 0, 'id_ID') as gaji"),
            DB::raw("FORMAT({$potongan}, 0, 'id_ID') as jml_potongan"),
            DB::raw("FORMAT((b.gaji_pokok + b.tj_transport + b.uang_makan) - {$potongan}, 0, 'id_ID') as total_gaji")        )
        ->get();

      return response()->json(['status' => 'Success', 'data' => $pegawaiQuery], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'potongan' => 'required',
            'jml_potongan' => 'required',
        ]);

        $input = $request->all();

        try {
            $Gaji = MstDataGaji::create([
                'potongan' => $input['potongan'],
                'jml_potongan' => $input['jml_potongan'],
            ]);

            return response()->json(['status' => 'success', 'data' => $Gaji], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e], 400);
        }
    }

    public function show($id){
        try{
            $Gaji = MstDataGaji::find($id);

            return response()->json(['status' => 'success', 'data' => $Gaji], 200);
        } catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e], 400);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'potongan' => 'required',
            'jml_potongan' => 'required',
        ]);

        $input = $request->all();

        $Gaji = MstDataGaji::find($id);
        $Gaji->potongan = $input['potongan'];
        $Gaji->jml_potongan = $input['jml_potongan'];
        $Gaji->save();

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $Gaji = MstDataGaji::find($id);
        if($Gaji == null){
            return response()->json(['status' => 'error', 'message' => 'Data Potongan Gaji tidak ditemukan!'], 422);
        }

        $Gaji->delete();
        return response()->json(['status' => 'success'], 200);
    }
}