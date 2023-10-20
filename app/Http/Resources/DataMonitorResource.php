<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataMonitorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            
            'kode_rup' => $this->kode_rup,
            'nama_paket' => $this->nama_paket,
            'satuan_kerja' => $this->satuan_kerja,
            'pdn' => $this->pdn,
            'umk' => $this->umk,

            'metode_pengadaan' => $this->metode_pengadaan,
            'jenis_pengadaan' => $this->jenis_pengadaan,
            'tahapan' => $this->tahapan,
         
            'status_paket' => $this->status_paket,
            'pagu_urp' => $this->pagu_urp,
            'nilai_hps' => $this->nilai_hps,
            'nilai_kontrak' => $this->nilai_kontrak,
            'efisiensi' => $this->efisiensi,
            'tahun	' => $this->tahun,
             
            

        ];
    }
}
