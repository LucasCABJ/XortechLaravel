<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    function settings(): View
    {
        return view('user.settings');
    }

    function update(Request $request)
    {

        if (isset($request->password)) {
            $request->validate([
                'password' => 'confirmed|min:8'
            ]);
        }

        $user = User::find(Auth::user()->id);
        $imgchange = false;

        if ($request->file('image')) {
            $imgchange = true;
            $filename = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/usup'), $filename);
        }

        $user->update([
            'name' => ($request->name != null) ? $request->name : $user->name,
            'image' => ($imgchange) ? $filename : $user->image,
            'password' => (isset($request->password)) ? Hash::make($request->password) : $user->password
        ]);

        return redirect()->route('home');
    }
}
