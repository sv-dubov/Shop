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

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function descendants() {
        return $this->hasMany(Category::class, 'parent_id')->with('descendants');
    }

    public static function roots() {
        return self::where('parent_id', 0)->with('children')->get();
    }

    public static function hierarchy() {
        return self::where('parent_id', 0)->with('descendants')->get();
    }

    public function validParent($id) {
        $id = (integer)$id;
        $ids = $this->getAllChildren($this->id);
        $ids[] = $this->id;
        return ! in_array($id, $ids);
    }

    public static function getAllChildren($id) {
        //get direct descendants of category with identifier $id
        $children = self::where('parent_id', $id)->with('children')->get();
        $ids = [];
        foreach ($children as $child) {
            $ids[] = $child->id;
            //for each direct descendant we get its direct descendants
            if ($child->children->count()) {
                $ids = array_merge($ids, self::getAllChildren($child->id));
            }
        }
        return $ids;
    }
}
