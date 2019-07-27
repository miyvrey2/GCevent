<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreOrUpdatePublisher;
use App\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PublisherController extends Controller
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
        // Get all platforms except the empty one
        $publishers = Publisher::orderBy('title', 'asc')->get();
        foreach($publishers as $key => $publisher) {
            if ($publisher['title'] === '---') {
                unset($publisher[$key]);
            }
        }

        return view('backend.publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null $title
     *
     * @return \Illuminate\Http\Response
     */
    public function create($title = null)
    {

        // Initiate a new platform with some defined values
        $publisher = new Publisher();

        if($title != null) {
            $publisher->title = $title;
        }

        return view('backend.publisher.create', compact('publisher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrUpdatePublisher $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdatePublisher $request)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // Save
        Publisher::create($data);

        return redirect('/admin/publishers');
    }

    /**
     * Display the specified resource.
     *
     * @param Publisher $publisher
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        return view('backend.publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Publisher $publisher
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('backend.publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrUpdatePublisher $request
     * @param  Publisher $publisher
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdatePublisher $request, Publisher $publisher)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Save the updates
        $publisher->update($data);

        return Redirect::to('/admin/publishers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Publisher $publisher
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Publisher $publisher)
    {
        // Delete the game
        $publisher->delete();

        return Redirect::to('/admin/publishers');

    }
}
