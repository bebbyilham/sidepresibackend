<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelatihan extends Model
{
    protected $table = 'data_pelatihan';

    protected $fillable = [
        'jenis_pelatihan', 'nama_pelatihan', 'tahun_pelaksanaan', 'jumlah_ipl', 'user_id', 'jumlah_skp', 'berlaku', 'user', 'status_pelatihan'
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
