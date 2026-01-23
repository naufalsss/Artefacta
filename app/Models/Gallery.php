<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'artifact_id',
        'is_published',
        'crop_x',
        'crop_y',
        'crop_width',
        'crop_height',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Get the artifact that this gallery item belongs to
     */
    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }
}
