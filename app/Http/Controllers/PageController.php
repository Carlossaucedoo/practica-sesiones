<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Página de inicio.
     */
    public function home(): View
    {
        return view('pages.home');
    }
}
