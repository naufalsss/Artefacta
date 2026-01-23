<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get all gallery items associated with this artifact
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
