// Probar JQUERY
// $(document).ready(function() {
//   alert ("Hola Mundo");
// // console.log('Query is working');
// });

// Submenus JQuery
$(document).ready(function () {
  $(".vertical_bar .menu li a").click(function () {
    $(".vertical_bar .menu li").removeClass("active");
    $(this).parent().addClass("active");
  });
});


// Agregar una nueva noticia con validaciones en 'insertar.php'
// $(document).ready(function () {
//   // console.log('Query is working');
//   // no permitir que recarge la pagina
//   $("#publicar_noticia").click(function (event) {
//     event.preventDefault();
//     let data = $("#formulario_noticias").serialize();
//     // probar datos ingresados
//     // alert(data);
//     // return false;
//     $.ajax({
//       type: "POST",
//       url: "./insertarNoticia.php",
//       data: data,
//       success: function (respuesta) {
//         // $("#contenido-ventana").html(respuesta);
//         if (respuesta == 1) {
//           // alert("agregado correctamente!!!");
//           $("#formulario_noticias").trigger("reset");
//         } else {
//           console.log(respuesta);
//           // resetear campos
//           // efecto de entrada y salida de mensaje
//           $("#succsess_mensaje").fadeIn().html(respuesta);
//           setTimeout(function () {
//             $("#succsess_mensaje").fadeOut("slow");
//           }, 3000);
//         }
//       },
//     });
//     // no permitir que recarge la pagina
//     // return false;
//   });
// });

// recetear campos al dar click en cancelar noticias
$("#cancelar_noticia").click(function () {
  $("#formulario_noticias").trigger("reset");
});
