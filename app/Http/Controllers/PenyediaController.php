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
       /*

        $query->Penyedia->leftJoin('idpemenang', 'detailpakets.idpemenang', '=', 'penyedias.id')
        ->selectRaw('penyedias.*, count(penyedias.id) as total')
        ->groupBy('npwp');
        */
        $query->selectRaw('nama, npwp, notel, alamat, count(*) as jumlah')
        ->leftJoin('detailpakets', 'detailpakets.idpemenang', '=', 'penyedias.id')
        ->groupBy('npwp');
        
       /* $query = Penyedia::select('penyedias.*')
        ->leftJoin('detailpakets', 'detailpakets.idpemenang', '=', 'penyedias.id')
        ->groupBy('npwp');
        */
        /*
        $query -> select('penyedias.*')
        ->leftJoin('detailpakets ', 'penyedias.id', '=', 'detailpakets.idpemenang')
        ->whereNull('detailpakets.idpemenang')->first();
        */
        $result = $query->get();

        return [
            'data' => $result
        ];
    }
}
