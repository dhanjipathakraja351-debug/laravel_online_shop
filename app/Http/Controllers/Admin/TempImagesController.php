<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempImage;

class TempImagesController extends Controller
{
    public function create(Request $request)
    {
        if($request->hasFile('image')){

            $image = $request->file('image');

            $ext = $image->getClientOriginalExtension();

            // Correct filename generation
            $newName = uniqid().'_'.$image->getClientOriginalName();

            // Save database record
            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            // Move file to temp folder
            $image->move(public_path('temp'), $newName);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'image' => $newName
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}