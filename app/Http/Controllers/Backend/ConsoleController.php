<?php

namespace App\Http\Controllers\Backend;

use App\Console;
use App\Http\Controllers\Controller;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConsoleController extends Controller
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
        // Get all consoles except the empty one
        $consoles = Console::orderBy('title', 'asc')->get();
        foreach($consoles as $key => $console) {
            if ($console['title'] === '---') {
                unset($consoles[$key]);
            }
        }

        return view('backend.console.index', compact('consoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Initiate a new console with some defined values
        $console = new Console();
        $console->released_at = date("Y") . "-00-00";
        $console->aliases = null;

        return view('backend.console.create', compact('console'));
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
            'title'         => 'required|string',
            'slug'          => 'required|string',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'image'         => 'nullable|string',
            'aliases'       => 'nullable|array',
            'released_at'   => 'nullable|string',
        ]);

        // make that slug readable
        $data['slug'] = str_replace(" ", "-", $data['slug']);
        $data['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $data['slug']);

        // Make from multiple aliases 1
        if(isset($data['aliases'])) {
            $data['aliases'] = implode(",", $data['aliases']);
        } else {
            $data['aliases'] = '';
        }

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // Save
        $console = Console::create($data);

        return redirect('/admin/consoles');
    }

    /**
     * Display the specified resource.
     *
     * @param Console $console
     * @return \Illuminate\Http\Response
     */
    public function show(Console $console)
    {
        return view('backend.console.show', compact('console'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Console $console
     * @return \Illuminate\Http\Response
     */
    public function edit(Console $console)
    {
        if($console['aliases'] != "") {
            $console['aliases'] = explode(',', $console['aliases']);
        } else {
            $console->keywords = null;
        }
        return view('backend.console.edit', compact('console'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Console $console
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Console $console)
    {
        // make that slug readable
        $request['slug'] = str_replace(" ", "-", $request['slug']);
        $request['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $request['slug']);

        // Make from multiple aliases 1
        if($request['aliases'] != null) {
            $request['aliases'] = implode(",", $request['aliases']);
        } else {
            $request['aliases'] = '';
        }

        // Save the updates
        $console->update($request->all());

        return Redirect::to('/admin/consoles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Console $console
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Console $console)
    {
        // Delete the game
        $console->delete();

        return Redirect::to('/admin/consoles');

    }
}
