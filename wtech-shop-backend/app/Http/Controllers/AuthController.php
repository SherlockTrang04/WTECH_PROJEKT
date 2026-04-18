<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showForm()
    {
        return view('registration');
    }

    public function register(Request $request)
    {
        // Validate
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'address_street' => 'nullable|string|max:255',
            'address_house_number' => 'nullable|string|max:10',
            'address_zip' => 'nullable|string|max:10',
            'address_city' => 'nullable|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address_street' => $request->address_street,
            'address_house_number' => $request->address_house_number,
            'address_zip' => $request->address_zip,
            'address_city' => $request->address_city,
            'password' => Hash::make($request->password),
        ]);

        // Log in immediately after registration
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Registrácia prebehla úspešne!');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'Nespravny email alebo heslo.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Odhlásenie prebehlo úspešne!');
    }

    public function updateUserInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'address_street' => 'nullable|string|max:255',
            'address_house_number' => 'nullable|string|max:10',
            'address_zip' => 'nullable|string|max:10',
            'address_city' => 'nullable|string|max:255',
        ]);

        auth()->user()->update($request->only(['name', 'username', 'email', 'phone', 'address_street', 'address_house_number', 'address_zip', 'address_city']));

        return back()->with('success', 'Informácie boli aktualizované!');
    }
}
