<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'tech_img_url'];

    public static function generateSlug($name)
    {
        return Str::slug($name, '-');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
    
}
