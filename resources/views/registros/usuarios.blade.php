@extends('diseño.navbar')

@section('title','Registro')

@section('content')


<?php $message = Session::get('message') ?>

@if ($message == 'store')
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        ¡Usuarios creado exitosamente!
    </div>
@endif

<!--Instruccion-->
<h4 class="text-center">Registrate es gratis</h4>
<h6 class="text-center">Una vez realizado tu registro tendras el privilegio de ofertar tus productos en nuestro sitio.</h6><br>

<!--Formulario-->
<div class="container" style="margin-left: 280px;">
    @csrf
    {!! Form::open(['route'=>'usuarios.store', 'method'=>'POST', 'files' => true, 'role' => 'form']) !!}
        
            
                <div class="row">
                    <div class="col-10 col-sm-4">
                        <div class="form-group">    
                           <input type="text" name="nombre" placeholder="Nombre" class="form-control"  required>
                        </div>
                        <div class="form-group">    
                            <input type="text" name="apellido" placeholder="Apellidos" class="form-control" required>
                        </div>
    
                        <div class="form-group" id="form"> 
                            <label style="color:white;" for="">Foto de perfil</label> <br>
                            <input id="file" type="file" name="avatar" required>
                        </div> 
                    </div>

                    <div class="col-10 col-sm-4" id="imagen_preview">
                        <div class="row">
                            <div class="col-xm preview card justify-content-center" style="width: 30rem; height: 12rem; margin-left:160px; padding-left: 21px; padding-right: 19px; padding-top: 13px; padding-bottom: 13px; " id="preview">
                                              
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="row">
                <div class="col-10 col-sm-8">
                    <div class="form-group">    
                        <input type="email" name="correo" placeholder="Correo electronico" class="form-control" required>
                    </div>
                
                    <div class="form-group">
                        <input type="text" name="facebook" placeholder="Facebook" class="form-control" required>
                    </div>
                
                    <div class="form-group">    
                        <input type="text" name="num_telefono" placeholder="Numero teléfonico" class="form-control" pattern="[0-9]{10}" required>
                    </div>
                
                    <div class="form-group">
                        <input type="text" name="usuario" placeholder="Nombre de usuario" class="form-control" required>
                    </div>
                
                    <div class="form-group">     
                        <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
                    </div>
                
                    <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                </div>
            </div>
</div>  

@endsection