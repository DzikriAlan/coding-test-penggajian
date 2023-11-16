<?php

namespace App\Http\Resources;
use App\User;
use App\MstDataJabatan;

use Illuminate\Http\Resources\Json\JsonResource;

class MstDataPegawaiResource extends JsonResource 
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        $jabatan = MstDataJabatan::find($this->jabatan_id);

        return [
            'id' => $this->id,
            'nama_pegawai' => $this->nama_pegawai,
            'email' => $user->email,
            'password' => $user->password,
            'nik' => $this->nik,
            'jenis_kelamin' => $this->jenis_kelamin,
            'jabatan' => $jabatan->nama_jabatan,
            'status' => $this->status
        ];
    }
}
