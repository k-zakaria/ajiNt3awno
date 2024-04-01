<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'role_id' => 'requred'
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => '3'
            ]);
    
            return redirect()->route('user.login');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.']);
        }
    }
    

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    try {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Les informations fournies ne correspondent pas.',
        ]);
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Une erreur s\'est produite lors de la connexion. Veuillez réessayer.']);
    }
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function get()
    {

        $users = User::with("role")->get();

        $roles = Role::all();


        return view('backOffice.user', compact('users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }
        
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->back()->with('success', 'Rôle de l\'utilisateur mis à jour avec succès.');
    }


    
}
