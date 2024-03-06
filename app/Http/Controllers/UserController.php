<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    function index(): View
    {
        $users = User::orderBy('id', 'asc')->paginate(3);

        return view('user.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    function edit(User $user): View
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Creates a new user
     * @param UserRequest $request
     * @return RedirectResponse
     */
    function create(UserRequest $request): RedirectResponse
    {
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

    /**
     * Updates a user
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    function updateUser(UserRequest $request, User $user): RedirectResponse
    {
        $user->update([
            'name' => $request->filled('name') ? $request->name : $user->name
        ]);

        return redirect()->back()->with('userUpdated', true);
    }

    /**
     * Soft Deletes a user
     * @param User $user
     * @return RedirectResponse
     */
    function destroy(User $user): RedirectResponse
    {
        if($user->id == Auth::user()->id){
            return redirect()->route('user.index')->with('cantInactivateYourself', true);
        }

        $user->update([
            "active" => false
        ]);

        return redirect()->route('user.index');

    }

    /**
     * Reactivates a user
     * @param User $user
     * @return RedirectResponse
     */
    function reactivate(User $user): RedirectResponse
    {
        $user->update([
            "active" => true
        ]);

        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    function settings(): View
    {
        return view('user.settings');
    }

    function updatePassword(Request $request): RedirectResponse
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

    /**
     * Updates the profile picture of the user
     * @param Request $request
     * @return RedirectResponse
     */
    function updateProfilePic(Request $request): RedirectResponse
    {
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

    /**
     * Updates the profile picture of the user
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    function editProfilePic(Request $request, User $user): RedirectResponse
    {
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

    /**
     * Updates the password of the user
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    function editPassword(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('passwordUpdated', true);
    }

    /**
     * Updates the user's profile
     * @param UserRequest $request
     * @return RedirectResponse
     */
    function update(UserRequest $request): RedirectResponse
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

    function updateEmail(Request $request) {

        $user = Auth::user();

        $request->validate([
            'email' => 'required|confirmed|unique:users,email'
        ]);

        $user->update([
            'email' => $request->email
        ]);

        return redirect()->route('user.settings')->with('userUpdated', true);

    }

    function updateUserEmail(User $user, Request $request) {

        $request->validate([
            'email' => 'required|confirmed|unique:users,email'
        ]);

        $user->update([
            'email' => $request->email
        ]);

        return redirect()->back()->with('userUpdated', true);

    }

    function updateUserRole(User $user, Request $request) {

        $request->validate([
            'role_id' => 'required'
        ]);
    
        $id = intval($request->role_id);

        if($user->id == Auth::user()->id) {
            return redirect()->back()->with('invalidId', true);
        }

        if($id < 1 || $id > 3) {
            return redirect()->back()->with('invalidId', true);
        }

        $user->update([
            'role_id' => $id
        ]);

        return redirect()->back()->with('userUpdated', true);

    }
}
