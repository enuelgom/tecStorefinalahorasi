{!! Form::open(['route'=>'producto.store', 'method'=>'POST', 'files' => true, 'role' => 'form']) !!}

    <div class="form-group">    
        <input type="text" name="nom_producto" value="" placeholder="Nombre del producto" class="form-control" required > 
    </div>

    <div class="form-group">    
         <input type="text" style="height: 7rem;" name="descripcion" placeholder="Descripción" class="form-control" required>
     </div>
                  
    <div class="form-group">    
        <input type="text" name="cantidad" placeholder="Cantidad" class="form-control" pattern="[0-9]{1,10}" required>
    </div>

    <div class="form-group">
        <input type="text" name="precio" placeholder="Precio" class="form-control" pattern="[0-9]{1,10}" required>
    </div>

    <h5>Selecciona imagenes del producto</h5>
 
    {{-- Seleccion de imagen --}}
    <div class="form-group" id="form"> 
        <input id="file" type="file" name="file" multiple>
    </div> 
    {{-- Seleccion de imagen --}}
    
    <button type="submit" class="btn btn-primary">Guardar</button> 
{!! Form::close() !!}