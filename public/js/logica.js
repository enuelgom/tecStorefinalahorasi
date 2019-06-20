document.getElementById("file").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
   // Leemos el archivo subido y se lo pasamos a nuestro fileReader 
    reader.onload = function(){
    preview = document.getElementById('preview'),
    image = document.createElement('img');
    image.style.height = "150px";
    image.style.width = "150px";

    image.src = reader.result;
    
    preview.innerHTML = '';
    preview.append(image);
  };
   reader.readAsDataURL(e.target.files[0]);
}


// "myAwesomeDropzone" es el ID de nuestro formulario usando la notación camelCase
Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro
  maxFilesize: 2 // Tamaño máximo en MB
};

