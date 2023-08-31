<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pipeline
 *
 * @property int $id
 * @property int $gitlab_pipeline_id
 * @property string $last_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereGitlabPipelineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereLastStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Pipeline extends Model
{
    use HasFactory;

    public $fillable = [
        'gitlab_pipeline_id',
        'last_status',
    ];
}
