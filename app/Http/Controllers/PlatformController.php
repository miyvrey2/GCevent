<?php

namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $platforms = Platform::orderBy('title', 'asc')->get();
        foreach($platforms as $key => $platform) {
            if ($platform['title'] === '---') {
                unset($platforms[$key]);
            }
        }

        return view('platform.index', compact('platforms'));
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

        return view('platform.show', compact('platform'));
    }
}
