<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Config
 *
 * @property int $id
 * @property string $gitlab_url
 * @property string $gitlab_api_token
 * @property int $pipeline_display_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereGitlabApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereGitlabUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config wherePipelineDisplayNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'current_project_id',
    ];

    public function isConfigured(): bool
    {
        return $this->gitlab_url && $this->gitlab_api_token;
    }
}
