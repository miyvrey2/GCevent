<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreOrUpdateDeveloper;
use App\Developer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DeveloperController extends Controller
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
        $developers = Developer::orderBy('title', 'asc')->get();
        foreach($developers as $key => $developer) {
            if ($developer['title'] === '---') {
                unset($developer[$key]);
            }
        }

        return view('backend.developer.index', compact('developers'));
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
        $developer = new Developer();

        if($title != null) {
            $developer->title = $title;
        }

        return view('backend.developer.create', compact('developer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrUpdateDeveloper  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdateDeveloper $request)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // Save
        Developer::create($data);

        return redirect('/admin/developers');
    }

    /**
     * Display the specified resource.
     *
     * @param Developer $developer
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Developer $developer)
    {
        return view('backend.developer.show', compact('developer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Developer $developer
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Developer $developer)
    {
        return view('backend.developer.edit', compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreOrUpdateDeveloper  $request
     * @param  Developer $developer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdateDeveloper $request, Developer $developer)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Save the updates
        $developer->update($data);

        return Redirect::to('/admin/developers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Developer $developer
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Developer $developer)
    {
        // Delete the game
        $developer->delete();

        return Redirect::to('/admin/developers');

    }
}
