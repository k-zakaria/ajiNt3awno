<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SettingController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('frontOffice.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/profile_images', $imageName);

            $user->image = 'profile_images/' . $imageName;
        }

        $user->update($validatedData);

        return redirect('/profile')->with('success', 'Profil mis à jour avec succès.');
    }
}
