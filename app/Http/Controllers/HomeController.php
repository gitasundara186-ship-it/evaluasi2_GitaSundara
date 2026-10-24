<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Landing Page";
        $buku = Buku::all();

        return view('frontpage.landingpage', compact('title', 'buku'));
    }
}