<?php

namespace App\Http\Controllers;

use App\Console;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $consoles = Console::orderBy('title', 'asc')->get();
        foreach($consoles as $key => $console) {
            if ($console['title'] === '---') {
                unset($consoles[$key]);
            }
        }

        return view('console.index', compact('consoles'));
    }

    /**
     * Display the specified resource.
     *
     * @param Console $console
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Console $console)
    {

        return view('console.show', compact('console'));
    }
}
