<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Un solo requerimiento
        //-----------------------------------------
        //$this->middleware('auth');
        //Varios requerimientos
        //-----------------------------------------
        ////$this->middleware('auth');
        ////$this->middleware('verified');
        //o
        $this->middleware(['auth', 'verified']);
    }

    public function show($id) {
        $user = User::findOrFail($id);

        return view('usuarios.perfil')->with([
            'user' => $user,
        ]);
    }

    public function update(Request $request) {
        $user = Auth::user();
        //Estableciendo reglas de validación
        $reglas = [
            //'nick' => ['required', 'string', 'max:255', 'unique:users'],
            'nick' => [
                'required', 'string', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ];
        //Validando petición
        $request->validate($reglas);

        //$user = Auth::user();
        $user->nick = $request->nick;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->direction = $request->direction;
        $user->phone = $request->phone;

        $user->save();

        return view('usuarios.perfil')->with([
            'user' => $user,
        ]);
    }
}
