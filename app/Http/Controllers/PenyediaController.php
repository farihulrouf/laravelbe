<?php

namespace App\Http\Controllers;

use App\Models\Penyedia;
use Illuminate\Http\Request;

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

    public function getJoinPenyedia() {
        $query = Penyedia::query();
      
        $query->selectRaw('penyedias.id, nama, npwp, notel, alamat, count(*) as jumlah')
        ->join('detailpros', 'detailpros.id', '=', 'penyedias.id')
        ->groupBy('npwp')->orderBy('jumlah', 'DESC');
      
        $result = $query->get();

        return [
            'data' => $result
        ];
    }
    public function getDetailpaketWin(Request $request) {
        $query = Penyedia::query();
        if ($id = $request->input('id')) {
            $query->selectRaw('datapakets.kode_rup, datapakets.satuan_kerja, 
            datapakets.nama_paket, datapakets.metode_pengadaan, 
            datapakets.nilai_kontrak, datapakets.tahun')
                ->join('detailpros', 'detailpros.id', '=', 'penyedias.id')
                ->join('datapakets','datapakets.kode_rup', '=', 'detailpros.kode_rup')
                ->whereRAW('penyedias.id =?', $id);
        }
        $result = $query->get();
        return [
            'data' => $result
        ];        

    }
}
