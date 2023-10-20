<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    protected $fillable = ['kode_rup', 'nama_paket', 'satuan_kerja', 
    'metode_pengadaan', 'umk', 'pdn',
     'nilai_kontrak', 'nilai_hps', 'pagu_urp', 'efisiensi', 'tahapan', 'status_paket',
     'jenis_pengadaan','tahun'
    ]; 
}
