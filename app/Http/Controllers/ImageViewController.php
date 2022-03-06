<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageViewController extends Controller
{
    public function viewImage(Request $request)
    {
        $path = $request->path;

        return view('app.appliances.image-view', compact('path'));
    }
}
