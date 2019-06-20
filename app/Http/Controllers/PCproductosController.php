<?php

namespace TecStore\Http\Controllers;

use Auth;
use DB;
use Session;
use Redirect;   
use TecStore\imagen;
use TecStore\productos;
use TecStore\user;
use Illuminate\Http\Request;

class PCproductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //buscar
        $nameItem = $request->get('nombres');
        $data = DB::table('users')
        ->join('productos','productos.id_usuario','users.id')
        ->join('imagen','productos.id','imagen.id_producto')
        ->where('productos.status','=','1')
        ->where('productos.nombre','like',"%$nameItem%")
        ->select(
            'users.nombre',
            'users.apellido',
            'users.avatar',
            'users.num_cel',
            'users.correo',
            'productos.precio',
            'productos.id',
            'productos.descripcion',
            'imagen.alt',
            'imagen.url')
        ->get();
        if($data)
        return view('index',['data'=>$data,'nameItem'=>$nameItem]);
        
    }
    public function perfil(){
        
        $item=DB::table('productos')
        ->join('imagen','productos.id','imagen.id_producto')
        ->where('productos.id_usuario','=',auth::user()->id)
        ->where('productos.status','=','1')
        ->select('productos.*','imagen.*')
        ->get();

        $itemSold=DB::table('productos')
        ->join('imagen','productos.id','imagen.id_producto')
        ->where('productos.id_usuario','=',auth::user()->id)
        ->where('productos.status','=','0')
        ->select('productos.*','imagen.*')
        ->get();
    
        return view('perfil_Usuario.perfil',['item'=>$item,'itemSold'=>$itemSold]);

    }

    public function showImg(){
        $show = imagen::where('id_producto');
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

        $producto = productos::create([
           'nombre' => $request['nom_producto'],
           'descripcion' => $request['descripcion'],
           'cantidad' => $request['cantidad'],
           'precio' => $request['precio'],
           'status' => '1',
           'id_usuario' => Auth::id(),
        ]);
        
        $this->img($request,$producto->id);
        return redirect('/perfil_Usuario')->with('message','store');
        
    }

    public function img(Request $request,$id){
        $nombre="";
        $archivo="";
    
        if($request->hasFile('file')){
            $archivo = $request->file('file');
            $nombre = time().$archivo->getClientOriginalName();
            $archivo->move(public_path().'/productos/',$nombre);
        }

        imagen::create([
            'id_producto' => $id,
            'url' => $nombre,
            'alt' => $request['nom_producto'],
        ]);

        
    }

    /* 
     * 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nombre)
    {
        $nombre_p = productos::where('nombre','=',$nombre);
        return view('perfil_Usuario.update',compact('nombre_p'));
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
    //Este causa el problema

    $producto = productos::where('id',$id)->get();
    $item=DB::table('productos')->join('imagen','productos.id','imagen.id_producto')->where('productos.id_usuario','=',auth::user()->id)->select('productos.*','imagen.*')->get();
    //return $item;
    return view('perfil_Usuario.update',['producto'=>$producto,'item'=>$item]);   
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
        $editar=productos::find($id);
        $editar->nombre = $request->get('nom_producto');
        $editar->descripcion = $request->get('descripcion');
        $editar->cantidad = $request->get('cantidad');
        $editar->precio = $request->get('precio');
        $editar->save();
        $this->imgUpdate($request,$id);
        return Redirect::to('perfil_Usuario');
    }
    public function imgUpdate(Request $request,$id_producto){
        $nombre="";
        $archivo="";
        
        $foto=imagen::where('id_producto','=',$id_producto)->first();
        
        if($request->hasFile('file')){
            $archivo = $request->file('file');
            $nombre = time().$archivo->getClientOriginalName();
            $archivo->move(public_path().'/productos/',$nombre);
        }else{
            $nombre=$foto->url;
        }

        imagen::where('id_producto','=',$id_producto)->update(array('url'=>$nombre,'alt'=>$request->get('nom_producto')));


  /*      imagen::create([
            'id_producto' => $id,
            'url' => $nombre,
            'alt' => $request['nom_producto'],
        ]);
*/
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editar=productos::find($id);
        $editar->status='0';
        $editar->save();
        return Redirect::to('perfil_Usuario');
    }

    public function ofrecer($id){
        $editar=productos::find($id);
        $editar->status='1';
        $editar->save();
        return Redirect::to('perfil_Usuario');
    }

//Consulta  

    public function scopeName($query, $nombre){
        if($nombre)
        return $query->where('nombre','like','%$nombre%');
    }

}
