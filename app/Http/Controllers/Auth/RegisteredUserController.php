<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
    * Display the registration view.
    */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
    * Handle an incoming registration request.
    *
    * @throws \Illuminate\Validation\ValidationException
    */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
            'username'    => ['string', 'min:3','unique:users'],
            'celuller_no' => ['string', 'min:11', 'max:12','unique:users'],
        ]);

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'username'    => $request->username,
            'celuller_no' => $request->celuller_no,
            'password'    => Hash::make($request->password),
        ]);

        //assign role to user
        $user->syncRoles('admin');

        return redirect()->to('console-signin')->with(['success' => 'Sign Up ' . $user['name'] . ' was successfully!']);

        // bawaan laravel breeze dinonakifkan
        // $user = event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
    }
}