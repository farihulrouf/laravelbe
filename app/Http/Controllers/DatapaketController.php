<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapaket;

class DatapaketController extends Controller
{
    public function getall()
    {
        return Datapaket::all();
    }
    public function search(Request $request)
    {
    }
    public function cari(Request $request)
    {
        $query = Datapaket::query();

        /* if ($s = $request->input('s')) {
            $query->whereRaw("nama_paket LIKE '%" . $s . "%'")
                ->orWhereRaw("satuan_kerja LIKE '%" . $s . "%'")
                ->orWhereRaw("metode_pengadaan LIKE '%" . $s . "%' ");
        }/*/
        if ($s = $request->input('s')) {
            $query->whereRaw("nama_paket LIKE '%" . $s . "%'");
        }
        if ($tahun = $request->input('tahun')) {
            $query->whereRAW('tahun =?', $tahun);
        }
        if ($jenis = $request->input('jenis')) {
            $query->whereRAW('jenis =?', $jenis);
        }
        if ($sk = $request->input('sk')) {
            $query->whereRAW('satuan_kerja =?', $sk);
        }

        if ($sort = $request->input('sort')) {
            $query->orderBy('nilai_kontrak', $sort);
        }

        $perPage = 10;
        $total = $request->input('total', 1);
        $total = $query->count();

        $result = $query->offset(($total - 1) * $perPage)->limit($perPage)->get();

        return [
            'data' => $result,
            'total' => $total,
            'total' => $total,
            'last_page' => ceil($total / $perPage)
        ];
    }
    public function getData(Request $request)
    {
        $query = Datapaket::query();
        if ($tahun = $request->input('tahun')) {
            $query->whereRAW('tahun =?', $tahun);
        }
        if ($jenis = $request->input('jenis')) {
            $query->whereRAW('jenis =?', $jenis);
        }
        if ($satuan = $request->input('satuan')) {
            $query->whereRAW('satuan_kerja =?', $satuan);
        }

        if ($metode = $request->input('metode')) {
            $query->whereRAW('metode_pengadaan =?', $metode);
        }

        $total = $query->count();
        $result = $query->get();
        return [
            'data' => $result,
            'total' => $total,
            'total' => $total
        ];
    }

    public function getdatametode(Request $request) {    
        $query = Datapaket::query();
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
    public function getStatistic(Request $request)

    {
        $query = Datapaket::query();
        if ($tahun = $request->input('tahun')) {
            $query->selectRaw('jenis, count(*) as jumlah, sum(nilai_kontrak) as total')
                ->whereRAW('tahun =?', $tahun)
                // ->whereRaw("spent_on >= '2018-04-10' and spent_on <= '2018-12-10'")
                ->groupBy('jenis');
        }

        if ($sk = $request->input('sk')) {
            $query->selectRaw('jenis, count(*) as jumlah, sum(nilai_kontrak) as total')
                ->whereRAW('satuan_kerja =?', $sk)
                // ->whereRaw("spent_on >= '2018-04-10' and spent_on <= '2018-12-10'")
                ->groupBy('jenis');
        }



        $result = $query->get();
        return [
            'data' => $result
        ];

        /* if ($s = $request->input('s')) {
            $query->whereRaw("nama_paket LIKE '%" . $s . "%'")
                ->orWhereRaw("satuan_kerja LIKE '%" . $s . "%'")
                ->orWhereRaw("metode_pengadaan LIKE '%" . $s . "%' ");
        }/*/
        // if ($s = $request->input('s')) {

        //   }
        //SELECT jenis, COUNT(*) as jumlah, SUM(nilai_kontrak) as total FROM datapakets GROUP BY jenis;
        //  SomeResource::collection($models)->groupBy('group');
        /*$data = Datapaket::select(

                            DB::raw("jenis, COUNT(*) as jumlah"),

                            DB::raw("SUM(nilai_kontrak) as total")

                            )

                          //  ->orderBy('created_at')

                            ->groupBy(DB::raw("jenis"))

                            ->get();
  

        dd($data);
        */
    }
}