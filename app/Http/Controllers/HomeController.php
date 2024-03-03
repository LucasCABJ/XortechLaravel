<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('home');
    }

    public function randomProduct(): View
    {
        $randomProduct = Product::where('active', true)
            ->inRandomOrder()
            ->first();
        return view('randomProduct', compact('randomProduct'));
    }
}
