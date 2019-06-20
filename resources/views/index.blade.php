@extends('diseño.interfaz')

@section('title','Inicio')

@section('content')
<!--Productos publicados mostrados en la pagina principal-->
<div class="container" id="principal">
      {{-- Este es la barra de busqueda --}}
    <br>  
        {{ Form::open(['route'=>'producto.index','method'=>'GET']) }}
          <div class="form-group">
            {{ Form::text('nombres', null,['class'=>'form-control mr-sm-2', 'placeholder'=>'Comienza a buscar','aria-label'=>'Search']) }}
          </div>   
          <div class="form-group">
            <center><button class="btn btn-success my-2 my-sm-0" id="btnBuscar" type="submit">Buscar</button></center>
          </div>
        {{ Form::close() }}

       {{-- Aqui termina la barra de busqueda --}}

       <div class="row">
          @foreach ($data as $producto)
            <div class="col-sm">
                <div class="card text-center" style="width: 18rem; margin-top: 40px;">
                                <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="productos/{{ $producto->url }}" alt="">                          
                            <div class="card-body">
                                <h5 class="card-title" style="color:black">{{ $producto->alt }}</h5>
                                <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio }}.00</p>
                                <p class="card-text"><strong>Descripción:</strong> {{ $descripcion=str_limit($producto->descripcion, 10) }}</p>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#producto-{{ $producto->id }}">Ver más...</button>
 
                            {{-- Aqui empeiza el modal --}}                             
                            <div class="modal fade" id="producto-{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle" style="color:black">{{ $producto->alt }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body container">
                                      {{-- Información del producto --}}
                                      <h5 style="color:black">Información</h5>
                                            <div class="row">
                                                <div class="col-6"">
                                                        <center>
                                                            <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF; " src="productos/{{ $producto->url }}" alt="">                          
                                                            <div class="card-body">
                                                              <h5 class="card-title" style="color:black">{{ $producto->alt }}</h5>
                                                              <p class="card-text"><strong>Precio: </strong>${{ $producto->precio }}.00</p>
                                                              <p class="card-text"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                                            </div>
                                                        </center>
                                                </div>
                                      {{-- Termina info del producto --}}  
        
                                      {{-- Información del usuario --}}        
                                                <div class="col-6">
                                                        <center>
                                                            <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="productos/{{ $producto->avatar }}" alt="">                          
                                                            <div class="card-body">
                                                              <h5 class="card-title" style="color:black">{{ $producto->nombre }} {{ $producto->apellido }}</h5>
                                                              <p class="card-text"><strong>Correo electrónico:</strong> {{ $producto->correo }}</p>
                                                              <p class="card-text"><strong>Número telefónico:</strong> {{ $producto->num_cel }}</p>
                                                            </div>
                                                        </center>
                                                  </div>  
                                            </div>
                                      {{-- Termina info del usuario --}} 
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
            </div>
          @endforeach 
         </div>

</div>

@endsection