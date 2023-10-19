<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenyediaResource extends JsonResource
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
            
            'npwp' => $this->npwp,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'notel' => $this->notel,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
