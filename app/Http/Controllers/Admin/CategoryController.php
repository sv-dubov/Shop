<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    public function index()
    {
        /*$roots = Category::roots();
        return view('admin.category.index', compact('roots'));*/
        $items = Category::all();
        return view('admin.category.index', compact('items'));
    }

    public function create()
    {
        /*$parents = Category::roots();
        return view('admin.category.create', compact('parents'));*/
        $items = Category::all();
        return view('admin.category.create', compact('items'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'integer',
            'name' => 'required|max:200',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'category');
        $category = Category::create($data);
        //$category = Category::create($request->all());
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'New category was created');
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        /*$parents = Category::roots();
        return view('admin.category.edit', compact('category', 'parents'));*/
        $items = Category::all();
        return view('admin.category.edit', compact('category', 'items'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'parent_id' => 'integer',
            'name' => 'required|max:200',
            'image' => 'mimes:jpeg,jpg,png|max:5000'
        ]);
        $category->slug = null; //change slug in DB
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');
        $category->update($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Category was edited');
    }

    public function destroy(Category $category)
    {
        if ($category->children->count()) {
            $errors[] = 'Cannot delete category with children';
        }
        if ($category->products->count()) {
            $errors[] = 'Cannot delete category with products';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category was deleted');
    }
}
