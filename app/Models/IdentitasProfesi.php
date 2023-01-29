<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasProfesi extends Model
{
    protected $table = 'identitas_profesis';

    protected $fillable = [
        'ijazah_terakhir', 'no_ijazah_terakhir', 'tahun_ijazah_terakhir', 'nama_institusi', 'jenis_profesi', 'user_id', 'jenjang_profesi', 'no_kta', 'user', 'tgl_daftar_anggota', 'no_str', 'str_berlaku', 'no_sikp', 'sikp_berlaku', 'no_penugasan', 'no_penugasan_berlaku'
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
