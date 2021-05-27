<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index() {
        $pages = Page::all();
        return view('admin.page.index', compact('pages'));
    }

    public function create() {
        $parents = Page::where('parent_id', 0)->get();
        return view('admin.page.create', compact('parents'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'parent_id' => 'required|regex:~^[0-9]+$~',
            'content' => 'required'
        ]);
        $page = Page::create($request->all());
        return redirect()->route('admin.page.show', ['page' => $page->id])->with('success', 'Page was created');
    }

    public function show(Page $page) {
        return view('admin.page.show', compact('page'));
    }

    public function edit(Page $page) {
        $parents = Page::where('parent_id', 0)->get();
        return view('admin.page.edit', compact('page', 'parents'));
    }

    public function update(Request $request, Page $page) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'parent_id' => 'required|regex:~^[0-9]+$~|not_in:'.$page->id,
            'content' => 'required'
        ]);
        $page->slug = null; //change slug in DB
        $page->update($request->all());
        return redirect()->route('admin.page.show', ['page' => $page->id])->with('success', 'Page was edited');
    }

    public function destroy(Page $page) {
        if ($page->children->count()) {
            return back()->withErrors('Cannot remove page with children');
        }
        $this->removeImages($page->content);
        $page->delete();
        return redirect()->route('admin.page.index')->with('success', 'Page was removed');
    }

    public function uploadImage(Request $request) {
        $validator = Validator::make($request->all(), ['image' => [
            'mimes:jpeg,jpg,png',
            'max:5000'
        ]]);
        if ($validator->passes()) {
            $path = $request->file('image')->store('page', 'public');
            $url = Storage::disk('public')->url($path);
            return response()->json(['image' => $url]);
        }
        return response()->json(['errors' => $validator->errors()->all()]);
    }

    public function removeImage(Request $request) {
        // $path = /storage/page/CW2xtBYIcXDx7d3oJRCLZoZtIhaSFWAS8Qa7WFL3.png
        $path = parse_url($request->image, PHP_URL_PATH);
        $path = str_replace('/storage/', '', $path);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return 'Image was removed';
        }
        return 'Cannot find image';
    }

    private function removeImages($content) {
        $dom = new \DomDocument();
        $dom->loadHtml($content);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            $pattern = '~/storage/page/([0-9a-f]{32}\.(jpeg|png|gif))~';
            if (preg_match($pattern, $src, $match)) {
                $name = $match[1];
                if (Storage::disk('public')->exists('page/' . $name)) {
                    Storage::disk('public')->delete('page/' . $name);
                }
            }
        }
    }
}
