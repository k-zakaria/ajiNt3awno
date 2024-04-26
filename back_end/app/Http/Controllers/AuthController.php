<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


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
            ]);
            
            $this->userRepository->create($request->all());

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

            if ($this->userRepository->attempt($credentials)) {
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
        $this->userRepository->logout();
        return redirect()->route('user.login');
    }

    public function get()
    {

        $users = $this->userRepository->getUsersWithRoles();
        $roles = $this->userRepository->getAllRoles();

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
