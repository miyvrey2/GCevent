<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\RSSItem;
use App\RSSWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RSSWebsiteController extends Controller
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
        $rss_websites = RSSWebsite::get();

        return view('backend.rsswebsite.index', compact('rss_websites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create a new article
        $rss_website = new RSSWebsite();

        return view('backend.rsswebsite.create', compact('rss_website'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $data = $this->validate($request, [
            'title'         => 'required',
            'url'           => 'required',
            'rss_url'       => 'required',
        ]);

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // save
        RSSWebsite::create($request->all());

        return redirect('/admin/rsswebsites');
    }

    /**
     * Display the specified resource.
     *
     * @param RSSWebsite $rss_website
     * @return \Illuminate\Http\Response
     */
    public function show(RSSWebsite $rss_website)
    {
        $rss_articles = RSSItem::where('rss_website_id', '=', $rss_website->id)->get();

        return view('backend.rsswebsite.show', compact('rss_website', 'rss_articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RSSWebsite $rss_website
     * @return \Illuminate\Http\Response
     */
    public function edit(RSSWebsite $rss_website)
    {
        return view('backend.rsswebsite.edit', compact('rss_website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  RSSWebsite $rss_website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RSSWebsite $rss_website)
    {
        // Validate
        $this->validate($request, [
            'title'         => 'required',
            'url'           => 'required',
            'rss_url'       => 'required',
        ]);

        // Save the updates
        $rss_website->update($request->all());

        return Redirect::to('/admin/rsswebsites');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RSSWebsite $rss_website
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(RSSWebsite $rss_website)
    {
        // Delete the game
        $rss_website->delete();

        return Redirect::to('/admin/rsswebsites');

    }
}
