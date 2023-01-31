<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // Modificar el Rquest
        $request->request->add(['username' => Str::slug($request-> username)]);
        //VALIDACIÓN CON LARAVEL
        $this->validate($request, [
            'name' => ['required', 'max:30'],
            'username' => ['required', 'max:20', 'min:3', 'unique:users'],
            'email' => ['required', 'unique:users', 'email', 'max:60'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        User::create([
            'name' => $request-> name,
            'username' => $request-> username,
            'email' => $request-> email,
            'password' => Hash::make( $request-> password )
        ]);

        // Autenticar
        auth()-> attempt([
            'email' => $request-> email,
            'password' => $request-> password,
        ]);

        //Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
