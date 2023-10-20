<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DatapaketResource extends JsonResource
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
            'metode_pengadaan' => $this->metode_pengadaan,
            'pdn' => $this->pdn,
            'umk' => $this->umk,
            'pradipa' => $this->pradipa,
            'tgl_kontrak' => $this->tgl_kontrak,
            'nilai_kontrak' => $this->nilai_kontrak,
            'awal_pelaksanaan' => $this->awal_pelaksanaan,
            'akhir_pelaksanaan' => $this->akhir_pelaksanaan,
            
            'progress	' => $this->progress,
             
            'tahun' => $this->tahun,

        ];
    }
}
