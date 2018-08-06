<?php

namespace App\Http\Controllers;

use App\Console;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
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
