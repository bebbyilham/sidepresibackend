<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'name', 'thumbnail', 'category', 'status', 'description', 'creator'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];

    //ambil data creator
    public function creator()
    {
        return $this->belongsTo('App\Models\Creator');
    }


    //ambil data images
    public function images()
    {
        return $this->hasMany('App\Models\ImageBlog')->orderBy('id', 'DESC');
    }

    // public function setStartDatetimeAttribute($casts)
    // {
    //     $this->attributes['created_at'] = \Carbon::parse($casts, $this->user->timezone)->tz(config('app.timezone'));
    // }
}
