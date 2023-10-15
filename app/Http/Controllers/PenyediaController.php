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
        ->leftJoin('detailpakets', 'detailpakets.idpemenang', '=', 'penyedias.id')
        ->groupBy('npwp')->orderBy('jumlah', 'desc');
      
        $result = $query->get();

        return [
            'data' => $result
        ];
    }
}
