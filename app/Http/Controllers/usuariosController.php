<?php

namespace TecStore\Http\Controllers;
use TecStore\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;

class usuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('registros.usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $nombre="";

         if($request->hasFile('avatar')){
            $archivo = $request->file('avatar');
            $nombre = time().$archivo->getClientOriginalName();
            $archivo->move(public_path().'/productos/',$nombre);
         }
        
            $usuario = new User();   
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido = $request->input('apellido');
            $usuario->avatar = $nombre;
            $usuario->correo = $request->input('correo');
            $usuario->facebook = $request->input('facebook');
            $usuario->num_cel = $request->input('num_telefono');
            $usuario->nom_usuario = $request->input('usuario');
            $usuario->password = bcrypt($request->input('password'));
            $usuario->save();
            return redirect('/usuarios')->with('message','store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $updateUser = User::where('id',Auth::user()->id)->get();
        return view('registros.updateUser',['updateUser'=>$updateUser]);  
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
        $name_update="";   

        if($request->hasFile('avatar')){
            $archivo = $request->file('avatar');
            $name_update = time().$archivo->getClientOriginalName();
            $archivo->move(public_path().'/productos/',$name_update);
        }else{
           $name_update=auth::user()->avatar;
        }
        
        $actualizar = Auth::user();
        $actualizar->nombre = $request->get('nombre');
        $actualizar->apellido = $request->get('apellido');
        $actualizar->avatar = $name_update;
        $actualizar->correo = $request->get('correo');
        $actualizar->facebook = $request->get('facebook');
        $actualizar->num_cel = $request->get('num_telefono');
        $actualizar->nom_usuario = $request->get('usuario');
        $actualizar->password = bcrypt($request->get('password'));
        $actualizar->save();
        return redirect::to('perfil_Usuario');
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
