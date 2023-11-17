<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstDataPotonganGaji extends Model
{
    protected $guarded = [];
    
    protected $table = 'mst_data_potongan_gaji'; 

    protected $fillable = [
        'potongan', 'jml_potongan'
    ];
}