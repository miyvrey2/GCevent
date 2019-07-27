<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function slugify($slug)
    {

        // Search and replace edge cases in the slug so it becomes URL proof
        $slug = str_replace(" ", "-", $slug);
        $slug = preg_replace("/[^a-zA-Z0-9-]+/", "", $slug);

        return $slug;
    }
}
