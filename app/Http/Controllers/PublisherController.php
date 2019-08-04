<?php

namespace App\Http\Controllers;

use App\Publisher;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        // Get additional info
        $publisher->stands = $publisher->stands()->get();
        $publisher->lineup2018 = $publisher->games()->linedUp(2018)->orderBy('title')->get();
        $publisher->lineup2019 = $publisher->games()->linedUp(2019)->orderBy('title')->get();
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
}
