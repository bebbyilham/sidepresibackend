<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPekerjaan extends Model
{
    protected $table = 'data_pekerjaans';

    protected $fillable = [
        'status_kepegawaian', 'nip', 'no_sk_pengangkatan', 'ruang_kerja', 'user_id', 'ruang_kerja_lain', 'jabatan', 'user', 'total_masa_kerja', 'tmt', 'riwayat_penempatan', 'kesesuaian'
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
