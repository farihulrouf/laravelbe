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
}
