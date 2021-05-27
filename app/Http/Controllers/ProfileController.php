<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        $profiles = auth()->user()->profiles()->paginate(4);
        return view('user.profile.index', compact('profiles'));
    }

    public function create() {
        return view('user.profile.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => 'in:' . auth()->user()->id,
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required',
        ]);
        $profile = Profile::create($request->all());
        return redirect()->route('user.profile.show', ['profile' => $profile->id])->with('success', 'Profile was created');
    }

    public function show(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }
        return view('user.profile.show', compact('profile'));
    }

    public function edit(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }
        return view('user.profile.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile) {
        $this->validate($request, [
            'user_id' => 'in:' . auth()->user()->id,
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required',
        ]);
        $profile->update($request->all());
        return redirect()->route('user.profile.show', ['profile' => $profile->id])->with('success', 'Profile was updated');
    }

    public function destroy(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }
        $profile->delete();
        return redirect()->route('user.profile.index')->with('success', 'Profile was deleted');
    }
}
