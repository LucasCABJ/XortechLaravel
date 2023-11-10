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

        $user = User::find(Auth::user()->id);

        if ($request->file('image')) {
            $filename = time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/usup'), $filename);
        }

        $user->update([
            'name' => ($request->name != null) ? $request->name : $user->name,
            "image" => (isset($filename)) ? $filename : ''
        ]);

        return redirect()->route('home');
    }
}
