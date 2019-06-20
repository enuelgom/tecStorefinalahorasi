@extends('diseño.navbar')

@section('title','Actualizar datos')

@section('content')

<!--Instruccion-->

<h4 class="text-center">Bienvenido {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h4>
<h6 class="text-center">Ahora puedes cambiar tus datos, editando los campos que quieras actualizar.</h6><br>

<!--Formulario-->
<div class="container">
    @csrf
    @foreach ($updateUser as $upUser)
    {!! Form::model($upUser,['route'=>['usuarios.update',$upUser->id], 'method'=>'PUT', 'files' => true, 'role' => 'form']) !!}
    <div class="row">
   
     <div class="col-12 col-sm-2" style=" margin-bottom: 10px;">
        <img src="/productos/{{  $upUser->avatar }}" style="width: 110px; height: 110px; margin-top=0;">
        <label style="margin-left:5px; color:white;">Imagen actual</label>
    </div>

    <div class="col-12 col-sm-3">
        <div class="form-group">    
            <input type="text" name="nombre" value="{{ $upUser->nombre }}" placeholder="Name" class="form-control" required>
        </div>
    
        <div class="form-group">    
            <input type="text" name="apellido" value="{{ $upUser->apellido }}" placeholder="Last name" class="form-control" required>
        </div>
    </div>
    
    <div class="col-12 col-sm-5">
        <div class="form-group" id="form"> 
            <label style="color:white;">Photo</label> <br>
            <input id="file" type="file" name="avatar">
        </div> 
    </div>
    
    <div class="col-12 col-sm-2" id="imagen_preview">
        <div class="row">
            <div class="col-xm preview card justify-content-center" style="width: 20rem; height: 10rem; padding-left: 8px; padding-right: 8px;"  id="preview">
                               
            </div>
        </div>
    </div>
</div>
            
                    
    <div class="form-group">    
        <input type="email" name="correo" value="{{ $upUser->correo }}" placeholder="Enter your email" class="form-control" required>
    </div>
                    
    <div class="form-group">
        <input type="text" name="facebook" value="{{ $upUser->facebook }}" placeholder="Enter your Facebook" class="form-control" required>
    </div>
                    
    <div class="form-group">    
        <input type="text" name="num_telefono" value="{{ $upUser->num_cel }}" placeholder="Number phone" class="form-control" pattern="[0-9]{10}" required>
    </div>
                    
    <div class="form-group">
        <input type="text" name="usuario" value="{{ $upUser->nom_usuario }}" placeholder="User Name" class="form-control" required>
    </div>
                    
    <div class="form-group">     
        <input type="password" name="password" placeholder="Contraseña" class="form-control">
    </div>
                    
      <center>  {!! Form::submit('Actualizar',['class'=>'btn btn-success']) !!} </center>
        {!! Form::close() !!}
    @endforeach
                
</div>
            
@endsection
