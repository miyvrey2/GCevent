<?php

namespace App\Http\Controllers\Backend;

use App\Page;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdatePage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all pages, ordered by the published date
        $pages = Page::orderBy('published_at', 'desc')->get();

        return view('backend.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create a new page
        $page = new Page();
        $page->published_at = null;
        $page->keywords = null;

        return view('backend.page.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrUpdatePage $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdatePage $request)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Change published_at date
        if($data['published_at'] != "") {
            $data['published_at'] = Carbon::parse($data['published_at'])->format("Y-m-d H:i:s");
        }

        // Change published_at date
        if($data['offline_at'] != "") {
            $data['offline_at'] = Carbon::parse($data['offline_at'])->format("Y-m-d H:i:s");
        }

        // Set author
        $data['author_id'] = Auth::user()->id;

        // Make from multiple keywords 1
        if(isset($data['keywords'])) {
            $data['keywords'] = implode(",", $data['keywords']);
        } else {
            $data['keywords'] = '';
        }

        // save
        Page::create($data);

        return redirect('/admin/pages');
    }

    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page)
    {
        $page->related = Page::where([['id', '!=', $page->id]])->published()->get();

        return view('page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        if($page['keywords'] != "") {
            $page['keywords'] = explode(',', $page['keywords']);
        } else {
            $page->keywords = null;
        }

        return view('backend.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreOrUpdatePage  $request
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdatePage $request, Page $page)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Change published_at date
        if($data['published_at'] != "") {
            $data['published_at'] = Carbon::parse($data['published_at'])->format("Y-m-d H:i:s");
        }

        // Change offline_at date
        if($data['offline_at'] != "") {
            $data['offline_at'] = Carbon::parse($data['offline_at'])->format("Y-m-d H:i:s");
        }

        // Make from multiple keywors 1
        if(isset($data['keywords'])) {
            $data['keywords'] = implode(",", $data['keywords']);
        } else {
            $data['keywords'] = '';
        }

        // Save the updates
        $page->update($data);

        return Redirect::to('/admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page $page
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        // Delete the page
        $page->delete();

        return Redirect::to('/admin/pages');

    }
}
