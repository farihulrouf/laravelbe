<?php

namespace App\Http\Controllers;
use App\Models\Monitoring;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DataMonitorResource;
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
    public function getDataAllMonitor(Request $request)
    {
        $query = Monitoring::query();
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
    public function SimpanDataMonitor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_rup' => 'required',
            'nama_paket' => 'required',
            'satuan_kerja' => 'required',
            'metode_pengadaan' =>'required',
            'jenis_pengadaan' => 'required',
            'tahapan' => 'required',
            'status_paket' => 'required',
            'pagu_urp' => 'required',
            'nilai_kontrak' => 'required',
            'nilai_hps' => 'required',
            'efisiensi' => 'required',
            'tahun' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }


        $post = Monitoring::create([
            'kode_rup' => $request->get('kode_rup'),
            'nama_paket' => $request->get('nama_paket'),
            'satuan_kerja' =>  $request->get('satuan_kerja'),
            'metode_pengadaan' => $request->get('metode_pengadaan'),
            'jenis_pengadaan' => $request->get('jenis_pengadaan'),
            'nilai_hps' =>  $request->get('nilai_hps'),
            'nilai_kontrak' =>  $request->get('nilai_kontrak'),
            'efisiensi' =>  $request->get('efisiensi'),
            'status_paket' =>  $request->get('status_paket'),
            'pagu_urp' =>  $request->get('pagu_urp'),
            'tahun' =>  $request->get('tahun'),
            'tahapan' =>  $request->get('tahapan'),
            'pdn' =>  $request->get('pdn'),
            'umk' =>  $request->get('umk'),
            
        ]);
        return response()->json([
            'data' => new DataMonitorResource($post),
            'message' => 'success',
            'success' => true
        ]);
    }
    public function HapusDataMonitor(Request $request)
    {

        $kode = $request->input('kode_rup');

        $barang = Monitoring::where('kode_rup', $kode)->get();

        if (!$barang->isEmpty()) {
            Monitoring::where('kode_rup', $kode)->delete();
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
