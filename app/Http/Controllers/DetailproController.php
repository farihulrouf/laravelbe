<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detailpro;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\DetailproResource;
//php artisan make:resource DetailProResource

class DetailproController extends Controller
{
    public function SimpanData(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'kode_rup' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }


        $post = Detailpro::create([
            'kode_rup' => $request->get('kode_rup'),
            'id' => $request->get('id'),
        ]);
        return response()->json([
            'data' => new DetailproResource($post),
            'message' => 'Post created successfully.',
            'success' => true
        ]);
    }


    public function HapusData(Request $request)
    {

        $query = Detailpro::query();
        if ($kode_rup = $request->input('kode_rup')) {
            $query->Detailpro::where('kode_rup', $kode_rup)->firstorfail()->delete();
        }

        return response()->json([
            'message' => 'Post created successfully.',
            'success' => true
        ]);
    }


    public function delete(Request $request)
    {
        $kode = $request->input('kode_rup');

        $barang = Detailpro::where('kode_rup', $kode)->get();

        if (!$barang->isEmpty()) {
            Detailpro::where('kode_rup', $kode)->delete();
            return response()->json([
                'message' => 'Post created successfully.',
                'success' => true
            ]);
        } else {
            return response()->json([
                'message' => 'failed deleted.',
                'success' => false
            ]);
        }
    }
}
