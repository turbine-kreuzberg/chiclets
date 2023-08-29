<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    use HasFactory;

    public $fillable = [
        'gitlab_pipeline_id',
        'last_status',
    ];
}
