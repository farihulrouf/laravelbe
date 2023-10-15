<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detailpaket;

class DetailpaketController extends Controller
{
    public function getData(Request $request)
    {
        $query = Detailpaket::query();
        if ($kode_rup = $request->input('koderup')) {
            $query->whereRAW('kode_rup =?', $kode_rup);
        }
      

        //$total = $query->count();
        $result = $query->get();
        return [
            'data' => $result,
           // 'total' => $total,
            //'total' => $total
        ];
    }

    public function  getDetailPemenang(Request $request){
        $query = Detailpaket::query();
        if ($idpemenang= $request->input('idpemenang')) {
            $query->selectRaw('detailpakets.idpemenang, pagu_paket, nilai_hps, detailpakets.nilai_kontrak, 
            detailpakets.kode_rup, datapakets.nama_paket, 
            datapakets.satuan_kerja, datapakets.metode_pengadaan, datapakets.tgl_kontrak,
            datapakets.awal_pelaksanaan,
            datapakets.akhir_pelaksanaan')
            ->leftJoin('datapakets', 'datapakets.kode_rup', '=', 'detailpakets.kode_rup')
            ->whereRAW('idpemenang =?', $idpemenang);
          
        }
       
        $result = $query->get();

        return [
            'data' => $result
        ];
    }
}
