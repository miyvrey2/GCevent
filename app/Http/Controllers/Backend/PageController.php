<?php

namespace App\Http\Controllers\Backend;

use App\Article;
use App\Http\Controllers\Controller;
use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        foreach($pages as $page) {
            if ($page->published_at == null) {
                $page->status = "Concept";
            } else if ($page->published_at > Carbon::now()) {
                $page->status = "Planned";
            } else {
                $page->status = "Published";
            }
        }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Change published_at date
        if($request['published_at'] != "") {
            $request['published_at'] = Carbon::parse($request['published_at'])->format("Y-m-d H:i:s");
        }
        // make that slug readable
        $request['slug'] = str_replace(" ", "-", $request['slug']);
        $request['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $request['slug']);

        // Written by
        $request['author_id'] = Auth::user()->id;

        // Make from multiple keywords 1
        if($request['keywords'] != null) {
            $request['keywords'] = implode(",", $request['keywords']);
        } else {
            $request['keywords'] = '';
        }

        // Validate
        $data = $this->validate($request, [
            'title'         => 'required',
            'subtitle'      => 'nullable|string',
            'slug'          => 'required',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'published_at'  => 'nullable|date_format:"Y-m-d H:i:s"',
            'keywords'      => 'nullable|string',
            'source'        => 'nullable|string',
        ]);

        // save
        Page::create($request->all());

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
     * @param  \Illuminate\Http\Request  $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        // Change published_at date
        if($request['published_at'] != "") {
            $request['published_at'] = Carbon::parse($request['published_at'])->format("Y-m-d H:i:s");
        }

        // make that slug readable
        $request['slug'] = str_replace(" ", "-", $request['slug']);
        $request['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $request['slug']);

        // Make from multiple keywors 1
        if($request['keywords'] != null) {
            $request['keywords'] = implode(",", $request['keywords']);
        } else {
            $request['keywords'] = '';
        }

        // Validate
        $this->validate($request, [
            'title'         => 'required',
            'subtitle'      => 'nullable|string',
            'slug'          => 'required',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'published_at'  => 'nullable|date_format:"Y-m-d H:i:s"',
            'keywords'      => 'nullable|string',
            'source'        => 'nullable|string',
        ]);

        // Save the updates
        $page->update($request->all());

        return Redirect::to('/admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        // Delete the article
        $page->delete();

        return Redirect::to('/admin/pages');

    }
}
