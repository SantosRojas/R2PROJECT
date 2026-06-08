<?php

namespace App\Models;

use Database\Factories\ProjectMediaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['project_id', 'type', 'url', 'title', 'caption', 'video_provider', 'video_id', 'sort_order'])]
class ProjectMedia extends Model
{
    /** @use HasFactory<ProjectMediaFactory> */
    use HasFactory;

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
