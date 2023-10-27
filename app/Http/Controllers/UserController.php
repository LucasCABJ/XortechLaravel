<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    function settings(): View
    {
        return view('user.settings');
    }

    function update(Request $request)
    {

        $filename = $request->file('image')->getClientOriginalName();
        $savedpath = $request->file('image')->storeAs('profilepics', $filename, 'public');

        $user = User::find(Auth::user()->id);

        $user->update([
            "image" => 'storage/' . $savedpath
        ]);

        return redirect()->route('home');
    }
}
