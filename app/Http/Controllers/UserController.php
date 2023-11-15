<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Image;

class UserController extends Controller
{

    function index()
    {
        $users = User::orderBy('id', 'asc')->get();

        return view('user.index', compact('users'));
    } 

    function edit(User $user){
        return view('user.edit', compact('user'));
    }

    function updateUser(Request $request, User $user){
        //
        $imgchange = false;

        if ($request->file('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imgchange = true;
            //filename with timestamp
            $filename = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/usup',$filename,'public');
        }

        $user->update([
            'name' => $request->filled('name') ? $request->name : $user->name,
            'email' => $request->filled('email') ? $request->email : $user->email
        ]);

        if ($imgchange) {
            $user->images()->updateOrCreate(
                ['imageable_type' => get_class($user)],
                ['url' => 'images/usup/' . $filename]
                );
        }
        return redirect()->route('user.edit', $user->id);
    }

    function destroy(User $user) {
        
        $user->update([
            "active" => false
        ]);

        return redirect()->route('user.index');

    }

    function reactivate(User $user) {
        
        $user->update([
            "active" => true
        ]);

        return redirect()->route('user.index');

    }

    function settings(): View
    {
        return view('user.settings');
    }

    function updatePassword(Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.settings')->with('passwordUpdated', true);
    }

    function update(Request $request)
    {

        $user = Auth::user();
        $imgchange = false;

        if ($request->file('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $imgchange = true;
            //filename with timestamp
            $filename = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/usup',$filename,'public');
        }

        $user->update([
            'name' => $request->filled('name') ? $request->name : $user->name,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password
        ]);

        if ($imgchange) {
            $user->images()->updateOrCreate(
                ['imageable_type' => get_class($user)],
                ['url' => 'images/usup/' . $filename]
                );
        }

        return redirect()->route('user.settings')->with('passwordUpdated', true);
    }
}
