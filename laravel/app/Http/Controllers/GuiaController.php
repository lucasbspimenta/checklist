<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guia;

class GuiaController extends Controller
{
    public function index()
    {
        $guias = Guia::all();
        return view('pages.guia.guia', compact('guias'));
    }

    public function show(Guia $guium, Request $request)
    {
        $guia = $guium;
        $modal = $request->modal ?? false;
        return view('pages.guia.show', compact('guia','modal'));
    }
}
