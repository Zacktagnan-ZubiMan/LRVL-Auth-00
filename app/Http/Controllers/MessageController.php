<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Un solo requerimiento
        //  >> Requerimiento de estar antentificado
        //  para poder acceder
        //-----------------------------------------
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $men = new Message;
        $array_error = array();
        $userto = User::where('nick', $request->input('to'))->first();

        if ($userto) {
            $men->message = $request->input('message');
            if (empty($men->message)) {
                $error=true;
                $array_error ['message'] = "El mensaje es vacío";
            }
            else {
                date_default_timezone_set('Europe/Madrid');
                $men->to = $userto->id;
                $men->from = $user->id;
                $men->datetime = date('Y-m-j H:i:s');
                $men->save();
                return redirect(route('messages.index'));
            }
        }
        else {
            $error=true;
            $array_error ['to']="El destinatario no existe";
        }

        if ($error) {
            return redirect(route('messages.create'))
            ->withInput()
            ->withErrors($array_error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
