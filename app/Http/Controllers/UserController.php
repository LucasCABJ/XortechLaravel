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
use App\Models\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(3);

        return view('user.index', compact('users'));
    }

    function edit(User $user){
        return view('user.edit', compact('user'));
    }

    function create(UserRequest $request){

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        $customerRole = Role::where('name', 'customer')->first();
        $user->role()->associate($customerRole);
        $user->save();

        return redirect()->back()->with('user_created', [$request->email, $request->password]);
    }

    function updateUser(UserRequest $request, User $user){
        
        $user->update([
            'name' => $request->filled('name') ? $request->name : $user->name
        ]);
        
        return redirect()->back()->with('userUpdated', true);
    }

    // function updateUserProfilePic(UserRequest $request, User $user){
    //     //
    //     $imgchange = false;

    //     $user->update([
    //         'name' => $request->filled('name') ? $request->name : $user->name,
    //         'email' => $request->filled('email') ? $request->email : $user->email
    //     ]);
        
    //     return redirect()->back()->with('userUpdated', true);
    // }

    function destroy(User $user) {

        if($user->id == Auth::user()->id){
            return redirect()->route('user.index')->with('cantInactivateYourself', true);
        }

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

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.settings')->with('passwordUpdated', true);
    }

    function updateProfilePic(Request $request) {
        $request->validate([
            'image' => 'image|required|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = Auth::user();
        $imgChange = false;
        if ($request->hasFile('image')) {
            $imgChange = true;
            $filename = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/images/usup', $filename, 'public');
        }
        $user->update([
            'image' => $imgChange ? $filename : $user->image
        ]);
        return redirect()->route('user.settings')->with('userUpdated', true);
    }

    function editProfilePic(Request $request, User $user) {
        $request->validate([
            'image' => 'image|required|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $imgChange = false;
        if ($request->hasFile('image')) {
            $imgChange = true;
            $filename = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/images/usup', $filename, 'public');
        }
        $user->update([
            'image' => $imgChange ? $filename : $user->image
        ]);
        return redirect()->route('user.edit', $user->id)->with('userUpdated', true);
    }

    function editPassword(Request $request, User $user)
    {

        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('passwordUpdated', true);
    }

    function update(UserRequest $request)
    {
        $user = Auth::user();
        $emailChange = false;

        if($request->email && $request->email != $user->email) $emailChange = true; 

        $user->update([
            'name' => $request->filled('name') ? $request->name : $user->name,
            'email' => $emailChange ? $request->email : $user->email
        ]);

        return redirect()->route('user.settings')->with('userUpdated', true);
    }
}
