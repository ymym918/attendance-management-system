<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'work_start_time',
        'work_end_time',
        'created_at',
        'updated_at'
    ];

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }
}
