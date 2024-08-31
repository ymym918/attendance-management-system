<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'work_id',
        'rest_start_time',
        'rest_end_time',
        'created_at',
        'updated_at'
    ];
}
