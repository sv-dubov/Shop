<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['parent_id', 'name', 'content', 'image'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getProducts() {
        return $this->hasMany(Product::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function roots() {
        return self::where('parent_id', 0)->with('children')->get();
    }
}
