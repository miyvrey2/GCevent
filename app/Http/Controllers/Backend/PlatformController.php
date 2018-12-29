<?php

namespace App\Http\Controllers\Backend;

use App\Platform;
use App\Http\Controllers\Controller;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PlatformController extends Controller
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
        $platforms = Platform::orderBy('title', 'asc')->get();
        foreach($platforms as $key => $platform) {
            if ($platform['title'] === '---') {
                unset($platforms[$key]);
            }
        }

        return view('backend.platform.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Initiate a new platform with some defined values
        $platform = new Platform();
        $platform->released_at = date("Y") . "-00-00";
        $platform->aliases = null;

        return view('backend.platform.create', compact('platform'));
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
        $platform = Platform::create($data);

        return redirect('/admin/platforms');
    }

    /**
     * Display the specified resource.
     *
     * @param Platform $platform
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Platform $platform)
    {
        return view('backend.platform.show', compact('platform'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Platform $platform
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Platform $platform)
    {
        if($platform['aliases'] != "") {
            $platform['aliases'] = explode(',', $platform['aliases']);
        } else {
            $platform->keywords = null;
        }
        return view('backend.platform.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Platform $platform
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Platform $platform)
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
        $platform->update($request->all());

        return Redirect::to('/admin/platforms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Platform $platform
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Platform $platform)
    {
        // Delete the game
        $platform->delete();

        return Redirect::to('/admin/platforms');

    }
}
