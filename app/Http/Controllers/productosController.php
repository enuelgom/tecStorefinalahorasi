<?php

namespace TecStore\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use TecStore\productos;
use TecStore\image;
use Illuminate\Support\Facades\DB;

class productosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        return DB::table('productos')
        ->where('status','1')
        ->join('users','productos.id_usuario','=','users.id')
        ->join('imagen','productos.id','=','imagen.id_producto')
        ->select('users.*','productos.*','imagen.*','productos.nombre as pro_name','users.nombre as user_name')
        ->orderBy('productos.id','desc')
        ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new productos;
        $producto->nombre = $request->nombre;
        $producto->descripcion=$request->descripcion;
        $producto->cantidad=$request->cantidad;
        $producto->precio=$request->precio;
        $producto->status=1;
        $producto->id_usuario=$request->id_usuario;
        $producto->save();

        return Response(['id'=>$producto->id]);
    }

    public function saveImage(Request $request)
    {
        $img = $request->file('image');
        $extension = $img->getClientOriginalExtension();
        Storage::disk('public')->put($img->getFilename().'.'.$extension,  File::get($img));
        
        $img_producto = new image;
        $img_producto->id_producto = $request->id_producto;
        $img_producto->alt = $img->getClientOriginalName();
        $img_producto->url = $img->getFilename().'.'.$extension;
        $img_producto->save();

        return "Completado";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return productos::where('id_usuario',$id)
        ->join('imagen','productos.id','=','imagen.id_producto')
        ->orderBy('id','desc')
        ->get();
    }

    public function searchItem($nombre)
    {
        return productos::where('productos.nombre', 'LIKE',"%$nombre%")
        ->join('users','productos.id_usuario','=','users.id')
        ->join('imagen','productos.id','=','imagen.id_producto')
        ->select('users.*','productos.*','imagen.*','productos.nombre as pro_name','users.nombre as user_name')
        ->orderBy('productos.id','desc')
        ->get();
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
        $data=DB::table('productos')->where('id', $id)->update(array('status'=>$request->status));
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           
    }
}
