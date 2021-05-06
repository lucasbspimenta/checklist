<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Image;

class ImagemController extends Controller
{
        /*
    public  function dropZone(Request $request)  
    {  
        $file = $request->file('file');

        $image = (string) Image::make($file->getRealPath())
                        ->resize(800, 600, function($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode('data-url');

        return response()->json(['success'=>$image]);
    }
    */

    public  function dropZone(Request $request)  
    { 
        $path = Storage::disk('temp')->path('/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
