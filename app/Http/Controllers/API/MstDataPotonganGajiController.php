<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use App\MstDataPotonganGaji;

class MstDataPotonganGajiController extends Controller
{
    const ITEM_PER_PAGE = 10;
    /**
    * Menampilkan halaman Data Potongan Gaji 
    *
    * 
    * @return \Illuminate\View\View
    */
    public function index(Request $request)
    {
      $searchParams = $request->all();
      $potonganGajiQuery = MstDataPotonganGaji::query();
      $search = Arr::get($searchParams, 'search', '');

      if (!empty($search)) {
          $potonganGajiQuery->where('potongan', 'LIKE', '%' . $search . '%');
          $potonganGajiQuery->orWhere('jml_potongan', 'LIKE', '%' . $search . '%');
      }

      return response()->json(['status' => 'Success', 'data' => MasterResource::collection($potonganGajiQuery->paginate(static::ITEM_PER_PAGE))], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'potongan' => 'required',
            'jml_potongan' => 'required',
        ]);

        $input = $request->all();

        try {
            $potonganGaji = MstDataPotonganGaji::create([
                'potongan' => $input['potongan'],
                'jml_potongan' => $input['jml_potongan'],
            ]);

            return response()->json(['status' => 'success', 'data' => $potonganGaji], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e], 400);
        }
    }

    public function show($id){
        try{
            $potonganGaji = MstDataPotonganGaji::find($id);

            return response()->json(['status' => 'success', 'data' => $potonganGaji], 200);
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

        $potonganGaji = MstDataPotonganGaji::find($id);
        $potonganGaji->potongan = $input['potongan'];
        $potonganGaji->jml_potongan = $input['jml_potongan'];
        $potonganGaji->save();

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $potonganGaji = MstDataPotonganGaji::find($id);
        if($potonganGaji == null){
            return response()->json(['status' => 'error', 'message' => 'Data Potongan Gaji tidak ditemukan!'], 422);
        }

        $potonganGaji->delete();
        return response()->json(['status' => 'success'], 200);
    }
}