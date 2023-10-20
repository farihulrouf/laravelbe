<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapaket extends Model
{
    use HasFactory;
    protected $fillable = ['kode_rup', 'nama_paket', 'satuan_kerja', 
    'metode_pengadaan', 'pradipa', 'tgl_kontrak', 'umk', 'pdn',
     'nilai_kontrak', 'awal_pelaksanaan', 'akhir_pelaksanaan', 'progress', 'tahun'
    ]; 


}
