<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    public $fillable = [
        'gitlab_url',
        'gitlab_api_token',
        'pipeline_display_number',
    ];
}
