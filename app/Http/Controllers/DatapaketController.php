<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapaket;

use App\Http\Resources\DatapaketResource;
use Illuminate\Support\Facades\Validator;
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
        if ($s = $request->input('s')) {
            $query->whereRaw("nama_paket LIKE '%" . $s . "%'");
        }
        if ($tahun = $request->input('tahun')) {
            $query->whereRAW('tahun =?', $tahun);
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

    public function getdatametode(Request $request)
    {
        $query = Datapaket::query();
        if ($tahun = $request->input('tahun')) {
            $query->selectRaw('metode_pengadaan, url, count(*) as jumlah, sum(nilai_kontrak) as total')
                ->whereRAW('tahun =?', $tahun)
                ->groupBy('metode_pengadaan', 'url');
        }

        if ($sk = $request->input('sk')) {
            $query->selectRaw('metode_pengadaan, url, count(*) as jumlah, sum(nilai_kontrak) as total')
                ->whereRAW('satuan_kerja =?', $sk)
                ->groupBy('metode_pengadaan', 'url');
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
    }

    public function getSwakelola(Request $request)
    {
        $query = Datapaket::query();

        if ($tahun = $request->input('tahun')) {

            $query->selectRaw('MONTHNAME(datapakets.tgl_kontrak) as bulan,MONTH(datapakets.tgl_kontrak) as bulanangka, datapakets.metode_pengadaan as metode, count(*) as jumlah,
            SUM(monitorings.pagu_urp) as pagu, SUM(monitorings.nilai_kontrak) as nilai_kontrak, SUM(monitorings.nilai_hps) as nilai_hps')
                ->join('monitorings', 'monitorings.kode_rup', '=', 'datapakets.kode_rup')
                ->whereRAW('datapakets.metode_pengadaan = "Swakelola"')
                ->whereRAW('datapakets.tahun =?', $tahun)
                ->groupByRaw('MONTHNAME(datapakets.tgl_kontrak)')
                ->orderBy('bulanangka', 'ASC');
        }

        $result = $query->get();
        return [
            'data' => $result
        ];
    }

    public function getSeleksi(Request $request)
    {
        $query = Datapaket::query();

        if ($tahun = $request->input('tahun')) {

            $query->selectRaw('MONTHNAME(datapakets.tgl_kontrak) as bulan,MONTH(datapakets.tgl_kontrak) as bulanangka, datapakets.metode_pengadaan as metode, count(*) as jumlah,
            SUM(monitorings.pagu_urp) as pagu, SUM(monitorings.nilai_kontrak) as nilai_kontrak, SUM(monitorings.nilai_hps) as nilai_hps')
                ->join('monitorings', 'monitorings.kode_rup', '=', 'datapakets.kode_rup')
                ->whereRAW('datapakets.metode_pengadaan = "Seleksi"')
                ->whereRAW('datapakets.tahun =?', $tahun)
                ->groupByRaw('MONTHNAME(datapakets.tgl_kontrak)')
                ->orderBy('bulanangka', 'ASC');
        }

        $result = $query->get();
        return [
            'data' => $result
        ];
    }

    public function getTender(Request $request)
    {
        $query = Datapaket::query();

        if ($tahun = $request->input('tahun')) {

            $query->selectRaw('MONTHNAME(datapakets.tgl_kontrak) as bulan,MONTH(datapakets.tgl_kontrak) as bulanangka, datapakets.metode_pengadaan as metode, count(*) as jumlah,
            SUM(monitorings.pagu_urp) as pagu, SUM(monitorings.nilai_kontrak) as nilai_kontrak, SUM(monitorings.nilai_hps) as nilai_hps')
                ->join('monitorings', 'monitorings.kode_rup', '=', 'datapakets.kode_rup')
                ->whereRAW('datapakets.metode_pengadaan = "Tender"')
                ->whereRAW('datapakets.tahun =?', $tahun)
                ->groupByRaw('MONTHNAME(datapakets.tgl_kontrak)')
                ->orderBy('bulanangka', 'ASC');
        }

        $result = $query->get();
        return [
            'data' => $result
        ];
    }

    public function getKecuali(Request $request)
    {
        $query = Datapaket::query();

        if ($tahun = $request->input('tahun')) {

            $query->selectRaw('MONTHNAME(datapakets.tgl_kontrak) as bulan,MONTH(datapakets.tgl_kontrak) as bulanangka, datapakets.metode_pengadaan as metode, count(*) as jumlah,
            SUM(monitorings.pagu_urp) as pagu, SUM(monitorings.nilai_kontrak) as nilai_kontrak, SUM(monitorings.nilai_hps) as nilai_hps')
                ->join('monitorings', 'monitorings.kode_rup', '=', 'datapakets.kode_rup')
                ->whereRAW('datapakets.metode_pengadaan = "Pengecualian"')
                ->whereRAW('datapakets.tahun =?', $tahun)
                ->groupByRaw('MONTHNAME(datapakets.tgl_kontrak)')
                ->orderBy('bulanangka', 'ASC');
        }

        $result = $query->get();
        return [
            'data' => $result
        ];
    }

    public function getPl(Request $request)
    {
        $query = Datapaket::query();

        if ($tahun = $request->input('tahun')) {
            $query->selectRaw('MONTHNAME(datapakets.tgl_kontrak) as bulan,MONTH(datapakets.tgl_kontrak) as bulanangka, datapakets.metode_pengadaan as metode, count(*) as jumlah,
            SUM(monitorings.pagu_urp) as pagu, SUM(monitorings.nilai_kontrak) as nilai_kontrak, SUM(monitorings.nilai_hps) as nilai_hps')
                ->join('monitorings', 'monitorings.kode_rup', '=', 'datapakets.kode_rup')
                ->whereRAW('datapakets.metode_pengadaan = "Penunjukan Langsung"')
                ->whereRAW('datapakets.tahun =?', $tahun)
                ->groupByRaw('MONTHNAME(datapakets.tgl_kontrak)')
                ->orderBy('bulanangka', 'ASC');
        }

        $result = $query->get();
        return [
            'data' => $result
        ];
    }

    
    public function getPurchas(Request $request)
    {
        $query = Datapaket::query();

        if ($tahun = $request->input('tahun')) {

            $query->selectRaw('MONTHNAME(datapakets.tgl_kontrak) as bulan,MONTH(datapakets.tgl_kontrak) as bulanangka, datapakets.metode_pengadaan as metode, count(*) as jumlah,
            SUM(monitorings.pagu_urp) as pagu, SUM(monitorings.nilai_kontrak) as nilai_kontrak, SUM(monitorings.nilai_hps) as nilai_hps')
                ->join('monitorings', 'monitorings.kode_rup', '=', 'datapakets.kode_rup')
                ->whereRAW('datapakets.metode_pengadaan = "E-Purchasing"')
                ->whereRAW('datapakets.tahun =?', $tahun)
                ->groupByRaw('MONTHNAME(datapakets.tgl_kontrak)')
                ->orderBy('bulanangka', 'ASC');

       
        }

        $result = $query->get();
        return [
            'data' => $result
        ];
    }

    public function getPengadanLangsung(Request $request)
    {
        $query = Datapaket::query();

        if ($tahun = $request->input('tahun')) {

            $query->selectRaw('MONTHNAME(datapakets.tgl_kontrak) as bulan,MONTH(datapakets.tgl_kontrak) as bulanangka, datapakets.metode_pengadaan as metode, count(*) as jumlah,
            SUM(monitorings.pagu_urp) as pagu, SUM(monitorings.nilai_kontrak) as nilai_kontrak, SUM(monitorings.nilai_hps) as nilai_hps')
                ->join('monitorings', 'monitorings.kode_rup', '=', 'datapakets.kode_rup')
                ->whereRAW('datapakets.metode_pengadaan = "Pengadaan Langsung"')
                ->whereRAW('datapakets.tahun =?', $tahun)
                ->groupByRaw('MONTHNAME(datapakets.tgl_kontrak)')
                ->orderBy('bulanangka', 'ASC');
        }

        $result = $query->get();
        return [
            'data' => $result
        ];
    }

    public function SimpanDatakontrak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_rup' => 'required',
            'nama_paket' => 'required',
            'satuan_kerja' => 'required',
            'metode_pengadaan' =>'required',
          
            'pradipa' => 'required',
            'tgl_kontrak' => 'required',
            'nilai_kontrak' => 'required',
            'awal_pelaksanaan' => 'required',
            'akhir_pelaksanaan' => 'required',
            'progress' => 'required',
            'tahun' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }


        $post = Datapaket::create([
            'kode_rup' => $request->get('kode_rup'),
            'nama_paket' => $request->get('nama_paket'),
            'satuan_kerja' =>  $request->get('satuan_kerja'),
            'metode_pengadaan' => $request->get('metode_pengadaan'),
            'pdn' =>  $request->get('pdn'),
            'umk' =>  $request->get('umk'),
            'pradipa' =>  $request->get('pradipa'),
            'tgl_kontrak' =>  $request->get('tgl_kontrak'),
            'nilai_kontrak' =>  $request->get('nilai_kontrak'),
            'awal_pelaksanaan' =>  $request->get('awal_pelaksanaan'),
            'akhir_pelaksanaan' =>  $request->get('akhir_pelaksanaan'),
            'progress' =>  $request->get('progress'),
            'tahun' =>  $request->get('tahun'),
            
        ]);
        return response()->json([
            'data' => new DatapaketResource($post),
            'message' => 'success',
            'success' => true
        ]);
    }

    public function HapusDataKontrak(Request $request)
    {

        $kode = $request->input('kode_rup');

        $barang = Datapaket::where('kode_rup', $kode)->get();

        if (!$barang->isEmpty()) {
            Datapaket::where('kode_rup', $kode)->delete();
            return response()->json([
                'message' => 'deleted successfully.',
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
