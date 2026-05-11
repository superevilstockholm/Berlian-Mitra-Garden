<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicController extends Controller
{
    public function index_view(): View
    {
        return view('pages.index');
    }
}
