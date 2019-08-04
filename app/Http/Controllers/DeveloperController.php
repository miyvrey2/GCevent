<?php

namespace App\Http\Controllers;

use App\Developer;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $developers = Developer::orderBy('title', 'asc')->get();
        foreach($developers as $key => $developer) {
            if ($developer['title'] === '---') {
                unset($developer[$key]);
            }
        }

        return view('developer.index', compact('developers'));
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
        // Get additional info
        $developer->games = $developer->games()->orderBy('title')->get();

        return view('developer.show', compact('developer'));
    }
}
