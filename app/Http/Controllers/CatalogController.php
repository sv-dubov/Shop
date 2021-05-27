<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index() {
        $roots = Category::where('parent_id', 0)->get();
        $brands = Brand::popular();
        return view('catalog.index', compact('roots', 'brands'));
    }

    public function category(Category $category) {
        //getting all descendants of the category
        $descendants = $category->getAllChildren($category->id);
        $descendants[] = $category->id;
        //products of the category and its descendants
        $products = Product::whereIn('category_id', $descendants)->paginate(5);
        return view('catalog.category', compact('category', 'products'));
    }

    public function brand(Brand $brand) {
        $products = $brand->products()->paginate(5);
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product(Product $product) {
        return view('catalog.product', compact('product'));
    }
}
