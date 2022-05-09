<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'category_id',
        'merk',
        'title',
        'display',
        'description',
        'price'
    ];

    public function scopeFilter($query, array $filters)
    {
        // if (isset($filters['search']) ? $filters['search'] : false) 
        $query->when($filters['search'] ?? false, function($query, $search)  {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orwhere('description', 'like', '%' . $search . '%');
        });
        
        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);                
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
