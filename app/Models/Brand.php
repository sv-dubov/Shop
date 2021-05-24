<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function getProducts() {
        return $this->hasMany(Product::class);
    }

    //not popular products, only which have the highest quantity
    public static function popular() {
        //return self::withCount('products')->orderByDesc('products_count')->limit(5)->get();
        return Brand::with('products')->take(5)->get();
    }
}
