<?php

namespace App\Http\Controllers;

use App\Exhibition;
use App\Page;

class ExhibitionController extends Controller
{
    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Exhibition $exhibition)
    {
        return view('exhibition.show', compact('exhibition'));
    }

    public function lineup(Exhibition $exhibition)
    {
        return view('exhibition.lineup', compact('exhibition'));
    }

    public function exhibitors(Exhibition $exhibition)
    {
        return view('exhibition.publisher', compact('exhibition'));
    }
}
