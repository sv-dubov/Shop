<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    public function index() {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create() {
        return view('admin.brand.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:200',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'brand');
        $brand = Brand::create($data);
        return redirect()->route('admin.brand.show', ['brand' => $brand->id])->with('success', 'New brand was created');
    }

    public function show(Brand $brand) {
        return view('admin.brand.show', compact('brand'));
    }

    public function edit(Brand $brand) {
        return view('admin.brand.edit',compact('brand'));
    }

    public function update(Request $request, Brand $brand) {
        $this->validate($request, [
            'name' => 'required|max:200',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);
        $brand->slug = null; //change slug in DB
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $brand, 'brand');
        $brand->update($data);
        return redirect()->route('admin.brand.show', ['brand' => $brand->id])->with('success', 'Brand was edited');
    }

    public function destroy(Brand $brand) {
        if ($brand->products->count()) {
            return back()->withErrors('Cannot delete brand with products');
        }
        $this->imageSaver->remove($brand, 'brand');
        $brand->delete();
        return redirect()->route('admin.brand.index')->with('success', 'Brand was deleted');
    }
}
