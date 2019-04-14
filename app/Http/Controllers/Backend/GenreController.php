<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreOrUpdateGenre;
use App\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class GenreController extends Controller
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
        $genres = Genre::orderBy('title', 'asc')->get();

        return view('backend.genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Initiate a new platform with some defined values
        $genre = new Genre();

        return view('backend.genre.create', compact('genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdateGenre $request)
    {
        $data = $request->validated();

        // make that slug readable
        $data['slug'] = str_replace(" ", "-", $data['slug']);
        $data['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $data['slug']);

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // Save
        Genre::create($data);

        return redirect('/admin/genres');
    }

    /**
     * Display the specified resource.
     *
     * @param Genre $genre
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return view('backend.genre.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Genre $genre
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('backend.genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Genre $genre
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdateGenre $request, Genre $genre)
    {
        // make that slug readable
        $request['slug'] = str_replace(" ", "-", $request['slug']);
        $request['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $request['slug']);

        // Save the updates
        $genre->update($request->all());

        return Redirect::to('/admin/genres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre $genre
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Genre $genre)
    {
        // Delete the game
        $genre->delete();

        return Redirect::to('/admin/genres');

    }
}
