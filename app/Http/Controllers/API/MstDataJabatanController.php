<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use Illuminate\Support\Arr;
use App\MstDataJabatan;
use DB;

class MstDataJabatanController extends Controller
{
  const ITEM_PER_PAGE = 10;
    /**
    * Menampilkan halaman Data Jabatan 
    *
    * 
    * @return \Illuminate\View\View
    */
    public function index(Request $request)
    {
      $searchParams = $request->all();
      $jabatanQuery = MstDataJabatan::query();
      $search = Arr::get($searchParams, 'search', '');

      if (!empty($search)) {
          $jabatanQuery->where('nama_jabatan', 'LIKE', '%' . $search . '%');
          $jabatanQuery->orWhere('gaji_pokok', 'LIKE', '%' . $search . '%');
          $jabatanQuery->orWhere('tj_transport', 'LIKE', '%' . $search . '%');
          $jabatanQuery->orWhere('uang_makan', 'LIKE', '%' . $search . '%');
      }
      $jabatanQuery->select(
        'id',
        'nama_jabatan',
        DB::raw("FORMAT((gaji_pokok), 0, 'id_ID') as gaji_pokok"),
        DB::raw("FORMAT((tj_transport), 0, 'id_ID') as tj_transport"),
        DB::raw("FORMAT((uang_makan), 0, 'id_ID') as uang_makan"),
      )
      ->get();

      return response()->json(['status' => 'Success', 'data' => MasterResource::collection($jabatanQuery->paginate(static::ITEM_PER_PAGE))], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required|string',
            'gaji_pokok' => 'required',
            'tj_transport' => 'required',
            'uang_makan' => 'required',
        ]);

        $input = $request->all();


        try {
            $jabatan = MstDataJabatan::create([
                'nama_jabatan' => $input['nama_jabatan'],
                'gaji_pokok' => $input['gaji_pokok'],
                'tj_transport' => $input['tj_transport'],
                'uang_makan' => $input['uang_makan'],
            ]);
            return response()->json(['data' => $input], 200);

            return response()->json(['status' => 'success', 'data' => $jabatan], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e], 400);
        }
    }

    public function show($id){
        try{
            $jabatan = MstDataJabatan::find($id);
            return response()->json(['status' => 'success', 'data' => $jabatan], 200);
        } catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e], 400);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama_jabatan' => 'required|string',
            'gaji_pokok' => 'required',
            'tj_transport' => 'required',
            'uang_makan' => 'required',
        ]);

        $input = $request->all();

        $jabatan = MstDataJabatan::find($id);
        $jabatan->nama_jabatan = $input['nama_jabatan'];
        $jabatan->gaji_pokok = $input['gaji_pokok'];
        $jabatan->tj_transport = $input['tj_transport'];
        $jabatan->uang_makan = $input['uang_makan'];
        $jabatan->save();

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $jabatan = MstDataJabatan::find($id);
        if($jabatan == null){
            return response()->json(['status' => 'error', 'message' => 'Jabatan tidak ditemukan!'], 422);
        }

        $jabatan->delete();
        return response()->json(['status' => 'success'], 200);
    }
}