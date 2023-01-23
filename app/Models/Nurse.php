<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    protected $table = 'nurses';

    protected $fillable = [
        'nama', 'no_ktp', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'user_id', 'user'
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
