<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstDataJabatan extends Model
{
    protected $guarded = [];
    
    protected $table = 'mst_data_jabatan'; 

    protected $fillable = [
        'nama_jabatan', 'gaji_pokok', 'tj_transport', 'uang_makan'
    ];
}