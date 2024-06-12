// Funcion para cargar archivos con parametros('donde', 'archivo')
function ajax(id_div, archivo) {
  const http = new XMLHttpRequest();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      document.getElementById(id_div).innerHTML = this.responseText;
    }
  };
  http.open("POST", archivo);
  http.send();
}


// Buscador
$(document).ready(function () {
  // no permitir que el buscador recarge la pagina
  $("#form_buscar").submit(function (event) {
    event.preventDefault();
  });
  $("#search_txt").keyup(function () {
    // si hay algun valor en el buscador (input)
    if ($("#search_txt").val()) {
      let search = $("#search_txt").val();
      // console.log(search);
      $.ajax({
        url: "insertarNoticia.php",
        type: "POST",
        data: { search },
        success: function (respuesta) {
          // console.log(respuesta);
          // convertir json strinng a json normal y almacenarlo en una variable arreglo
          let datoNoticia = JSON.parse(respuesta);
          // probar que se imprime como arreglo en consola
          // console.log(datoNoticia);
          // plantilla
          let template = "";
          // recorrer el arreglo con forEach()[]
          datoNoticia.forEach((datoNoticia) => {
            // probar resultados
            // console.log(datoNoticia);
            template += `<li class="resultados">${datoNoticia.titulo}</li>`;
          });
          $("#contenido").html(template);
        },
      });
    }
  });
});

// Guardar una nueva noticia
function registrar() {
  //   // guaradar los datos en una variable
  let titulo = $("#titulo").val();
  let portada_noticia = $("#portada").val();
  let descripcion = $("#descripcion").val();
  let categoria = $("#categoria").val();
  if (titulo.length == 0) {
    return Swal.fire("Titulo vacio", "El titulo esta vacio", "warning");
  } else if (titulo.length > 255) {
    return Swal.fire(
      "Muy largo",
      "El titulo supera los 500 caracteres",
      "warning"
    );
  }
  if (descripcion.length == 0) {
    return Swal.fire(
      "Descricion",
      "La descripcion no debe estar vacia",
      "warning"
    );
  }

  var formData = new FormData();
  var foto_portada = $("#portada")[0].files[0];
  formData.append("titulo", titulo);
  formData.append("portada", foto_portada);
  formData.append("descripcion", descripcion);
  formData.append("categoria", categoria);

  $.ajax({
    url: "insertarNoticia.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta) {
        return Swal.fire(respuesta);
      }
    },
  });

  return false;
  //   return false;
  //   // probar datos ingresados
  //   // console.log(postData);
  //   // enviar los datos con POST al archivo php y obtener una respuesta
  //   // $.post("insertarNoticia.php", postData, function (respuesta) {
  //   //   if (confirm(respuesta)) {
  //   //   // probar
  //   //   console.log(respuesta);
  //   //   // receterar los campos del formulario
  //   //   // $("#formulario_noticias").trigger("reset");
  //   //   // enviar mensaje a etiqueta en el formulario con efecto 'fade()'
  //   //   $("#succsess_mensaje").fadeIn().html(respuesta);
  //   //   // duracion del efecto de mensaje
  //   //   setTimeout(function () {
  //   //     $("#succsess_mensaje").fadeOut("slow");
  //   //   }, 3000);
  //   //   }
  //   // });
}

// function limpiar_campos() {
//   $("#formulario_noticias").trigger("reset");
// }
