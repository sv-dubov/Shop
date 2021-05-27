<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Page extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['parent_id', 'name', 'content'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function children() {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Page::class);
    }

    public function getRouteKeyName() {
        $current = Route::currentRouteName();
        if ('page.show' == $current) {
            return 'slug'; //public part
        }
        return 'id'; //admin part
    }
}
