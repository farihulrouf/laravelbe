<?php

namespace App\Http\Controllers;

use App\Models\Penyedia;
use Illuminate\Http\Request;
use App\Http\Resources\PenyediaResource;

use Illuminate\Support\Facades\Validator;

class PenyediaController extends Controller
{
    public function getallpenyedia()
    {
        // return Penyedia::all();
        $result = Penyedia::all();
        return [
            'data' => $result,
            // 'total' => $total,
            //'total' => $total
        ];
    }

    public function getJoinPenyedia()
    {
        $query = Penyedia::query();

        $query->selectRaw('penyedias.id, nama, npwp, notel, alamat, count(*) as jumlah')
            ->join('detailpros', 'detailpros.id', '=', 'penyedias.id')
            ->groupBy('npwp')->orderBy('jumlah', 'DESC');

        $result = $query->get();

        return [
            'data' => $result
        ];
    }
    public function getDetailpaketWin(Request $request)
    {
        $query = Penyedia::query();
        if ($id = $request->input('id')) {
            $query->selectRaw('datapakets.kode_rup, datapakets.satuan_kerja, 
            datapakets.nama_paket, datapakets.metode_pengadaan, 
            datapakets.nilai_kontrak, datapakets.tahun')
                ->join('detailpros', 'detailpros.id', '=', 'penyedias.id')
                ->join('datapakets', 'datapakets.kode_rup', '=', 'detailpros.kode_rup')
                ->whereRAW('penyedias.id =?', $id);
        }
        $result = $query->get();
        return [
            'data' => $result
        ];
    }


    public function SimpanPenyedia(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'npwp' => 'required',
            'nama' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $post = Penyedia::create([
            'npwp' => $request->get('npwp'),
            'nama' => $request->get('nama'),
            'notel' => $request->get('notel'),
            'alamat' => $request->get('alamat'),
        ]);
        return response()->json([
            'data' => new PenyediaResource($post),
            'message' => 'Post created successfully.',
            'success' => true
        ]);
    }
   


    public function hapusPenyedia(Request $request)
    {
        $id = $request->input('id');

        $penyedia = Penyedia::where('id', $id)->get();

        if (!$penyedia->isEmpty()) {
            Penyedia::where('id', $id)->delete();
            return response()->json([
                'message' => 'Post deleted successfully.',
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
