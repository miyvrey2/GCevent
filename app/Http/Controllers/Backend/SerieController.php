<?php

namespace App\Http\Controllers\Backend;

use App\Serie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreOrUpdateSerie;

class SerieController extends Controller
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
        // Get all series except the empty one
        $series = Serie::orderBy('title', 'asc')->get();

        return view('backend.serie.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Initiate a new serie with some defined values
        $serie = new Serie();

        return view('backend.serie.create', compact('serie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdateSerie $request)
    {
        $data = $request->validated();

        // make that slug readable
        $data['slug'] = str_replace(" ", "-", $data['slug']);
        $data['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $data['slug']);

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // Save
        Serie::create($data);

        return redirect('/admin/series');
    }

    /**
     * Display the specified resource.
     *
     * @param Serie $serie
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        return view('backend.serie.show', compact('serie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Serie $serie
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        return view('backend.serie.edit', compact('serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Serie $serie
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdateSerie $request, Serie $serie)
    {
        // make that slug readable
        $request['slug'] = str_replace(" ", "-", $request['slug']);
        $request['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $request['slug']);

        // Save the updates
        $serie->update($request->all());

        return Redirect::to('/admin/series');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Serie $serie
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Serie $serie)
    {
        // Delete the serie
        $serie->delete();

        return Redirect::to('/admin/series');

    }
}
