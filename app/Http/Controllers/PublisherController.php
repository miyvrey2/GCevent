<?php

namespace App\Http\Controllers;

use App\Game;
use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $publishers = Publisher::orderBy('title', 'asc')->get();
        foreach($publishers as $key => $publisher) {
            if ($publisher['title'] === '---') {
                unset($publishers[$key]);
            }
        }

        return view('publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        // Get additional info
        $publisher->stands = $publisher->stands()->get();
        $publisher->lineup = $publisher->games()->linedUp(2018)->orderBy('title')->get();
        $publisher->games = $publisher->games()->orderBy('title')->get();

        // Fetch all the halls
        $halls = array();
        foreach($publisher->stands as $stand){
            if(!in_array($stand->hall, $halls)) {
                $halls[] = $stand->hall;
            }
        }

        $publisher->halls = (count($halls) == 0)? array("unknown"): $halls;

        return view('publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
