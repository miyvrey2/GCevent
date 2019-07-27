<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // Homepage
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('page.home');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $pages = Page::published()->get();

//        $pages = Page::with('author')
//                     ->latest()
//                     ->published();

        return view('page.index', compact('pages'));
    }

    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page)
    {
        if(($page->status == $page->enumStatuses['pu']) || ($page->status == $page->enumStatuses['dr'] && Auth::check())) {
            return view('page.show', compact('page'));
        } else {
            abort(404);
        }
    }
}
