<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section_id' => 'required|exists:sections,id',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'images/' . time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
        }

        Image::create([
            'image' => $imageName,
            'section_id' => $validatedData['section_id'],
        ]);

        return redirect()->back()->with('success', 'Image ajoutée avec succès!');
    }
}
