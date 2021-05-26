<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    public function index() {
        $roots = Category::where('parent_id', 0)->get();
        $products = Product::paginate(5);
        return view('admin.product.index', compact('products', 'roots'));
    }

    public function category(Category $category) {
        $products = $category->products()->paginate(5);
        return view('admin.product.category', compact('category', 'products'));
    }

    public function create() {
        $items = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('items', 'brands'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:200',
            'price' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'product');
        $product = Product::create($data);
        return redirect()->route('admin.product.show', ['product' => $product->id])->with('success', 'New product was created');
    }

    public function show(Product $product) {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product) {
        $items = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'items', 'brands'));
    }

    public function update(Request $request, Product $product) {
        $this->validate($request, [
            'name' => 'required|max:200',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);
        $product->slug = null; //change slug in DB
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $product, 'product');
        $product->update($data);
        return redirect()->route('admin.product.show', ['product' => $product->id])->with('success', 'Product was edited');
    }

    public function destroy(Product $product) {
        $this->imageSaver->remove($product, 'product');
        $product->delete();
        return redirect()->route('admin.category.index')->with('success', 'Product was deleted');
    }
}
