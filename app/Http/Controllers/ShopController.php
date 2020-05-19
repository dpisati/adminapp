<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.ecommerce');
    }
}
