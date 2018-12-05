<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id) {
        $user = User::findOrFail($id);

        return view('usuarios.perfil')->with([
            'user' => $user,
        ]);
    }
}
