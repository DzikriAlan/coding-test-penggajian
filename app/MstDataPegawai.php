<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstDataPegawai extends Model
{
    protected $guarded = [];
    
    protected $table = 'mst_data_pegawai'; 

    protected $fillable = [
        'jabatan_id', 'user_id', 'nik', 'nama_pegawai', 'password',
        'jenis_kelamin', 'jabatan', 'tanggal_masuk',
        'status', 'photo', 'hak_akses'
    ];
}