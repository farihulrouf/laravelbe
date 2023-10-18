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

}
