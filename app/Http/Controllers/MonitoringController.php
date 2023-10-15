<?php

namespace App\Http\Controllers;
use App\Models\Monitoring;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function getDataDetail(Request $request)
    {
        $query = Monitoring::query();
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

    public function getdatametodemonitoring(Request $request) {    
        $query = Monitoring::query();
        if ($tahun = $request->input('tahun')) {
            $query->selectRaw('metode_pengadaan, url, count(*) as jumlah, sum(nilai_kontrak) as total')
                ->whereRAW('tahun =?', $tahun)
                ->groupBy('metode_pengadaan','url');
        }

        if ($sk = $request->input('sk')) {
            $query->selectRaw('metode_pengadaan, url, count(*) as jumlah, sum(nilai_kontrak) as total')
                ->whereRAW('satuan_kerja =?', $sk)
                ->groupBy('metode_pengadaan','url');
        }



        $result = $query->get();
        return [
            'data' => $result
        ];
    }
   

}
