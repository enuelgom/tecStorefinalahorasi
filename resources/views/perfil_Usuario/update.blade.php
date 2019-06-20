
@extends('diseño.navbar')

@section('title','Nombre_usuario')

@section('content')

@include('ventanas.errors')
<?php $message = Session::get('message') ?>

@if ($message == 'store')
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        ¡producto registrado exitosamente!
    </div>
@endif
<!--Informacion del perfil de usuario-->
<div class="container-fluid" id="inforPerfil">
    <div class="row">
        <div class="col-10 col-sm-4">
            <div class=" card text-center" style="width: 20rem; margin-top: 50px;">
                <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; margin-top: 10px; width: 200px; background-color: #EFEFEF;" src="/productos/{{  Auth::user()->avatar }}" alt="">
                <div class="card-body">

                    <h5 class="card-title" style="color: black">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h5>
                    <p class="card-text">Last name: {{ Auth::user()->apellido }}</p>
                    <p class="card-text">Email: {{ Auth::user()->correo }}</p>
                    <p class="card-text">Number phone: {{ Auth::user()->num_cel }}</p>
                    <a href="/editar/{{ Auth::user()->id  }}" class="btn btn-primary">Editar perfil</a>
                </div>
             </div>
        </div>  
        
<!--Registro de productos-->    
    <div class="col-10 col-sm-4" id="perfil" style="width: 20rem; margin-top: 40px;">
        <h5>Ahora puedes Actualizar tus productos</h5>
        
        @foreach ($producto as $data)
        {!! Form::model($producto,['route'=>['producto.update',$data->id], 'method'=>'PUT', 'files' => true, 'role' => 'form']) !!}
        <div class="form-group">    
            <input type="text" name="nom_producto" value="{{ $data->nombre }}" placeholder="Nombre" class="form-control"  required>
        </div>
        
        <div class="form-group">    
            <input type="text" style="height: 7rem;" name="descripcion"  value="{{ $data->descripcion }}" placeholder="Description" class="form-control" required>
        </div>
        
        <div class="form-group">    
            <input type="text" name="cantidad" value="{{ $data->cantidad }}" placeholder="Cantidad" class="form-control" pattern="[0-9]{1,10}" required>
        </div>
        
        <div class="form-group">
            <input type="text" name="precio" value="{{ $data->precio }}" placeholder="Precio" class="form-control" pattern="[0-9]{1,10} required>
        </div>
        
        <h5>Selecciona imagenes del producto</h5>
                   
        {{-- Seleccion de imagen --}}
        <div class="form-group" id="form"> 
            <input id="file" type="file" name="file" multiple>
        </div> 
        {{-- Seleccion de imagen --}}

        {!! form::submit('Actualizar',['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
        @endforeach
    </div>

    <div class="col-10 col-sm-4" id="imagen_preview">
        <h5 class="text-center" style="margin-top:40px;">Imagen del producto</h5>
        <div class="col-xm preview card justify-content-center" style="width: 30rem; height: 12rem; margin-left:103px; padding-left: 21px; padding-right: 19px; padding-top: 13px; padding-bottom: 13px; " id="preview">
                                                      
        </div>        
    </div>
     
<!--Productos previamente publicados por el usuario-->
    <div class="container-fluid" id="registrados">
        <hr>
            <h2>Productos registrados</h2>
            <h6>En este apartado podra visualizar los productos que haya registrado.</h6>
    <div class="row">  
        {{-- productos del usuario --}}
        @foreach ($item as $dato)
        <div class="col-sm">
            <div class="card text-center" style="width: 18rem; margin-top: 40px;">
                    <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="/productos/{{ $dato->url }}"  alt="">
                <div class="card-body">
                    <h5 class="card-title" style="color:black">{{ $dato->nombre }}</h5>
                    <p class="card-text"><strong>Precio: ${{ $dato->precio }}</strong></p>
                    <p class="card-text"><strong>Descripción: {{ $dato->descripcion }}</strong></p>
                    <a href="/producto/{{ $dato->id  }}" class="btn btn-primary">editar</a>
                    {{-- comment
                        {!! link_to_route('producto.edit',$title='Editar', $parameters=$dato->id, $attributes=['class'=>'btn btn-success']) !!}
                        {!! link_to_route('producto.destroy', $title='Eliminar', $parameters=$dato->id, $attributes=['class'=>'btn btn-danger']) !!}
                        --}}
                </div>
            </div>
        </div>    
        @endforeach
    </div>
</div>

</div>

<script src="{{ asset('js/logica.js') }}"></script>


@endsection
