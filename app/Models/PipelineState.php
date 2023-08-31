<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pipeline
 *
 * @property int $id
 * @property array $current_state
 * @property int $project_id
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
class PipelineState extends Model
{
    use HasFactory;

    public $fillable = [
        'current_state',
        'project_id',
    ];
}
