function tiempo_Real() {
  let tabla = $.ajax({
    url: "listar_noticias_HOME.php",
    datatype: "text",
    async: false,
  }).responseText;

  document.getElementById("news").innerHTML = tabla;
}
setInterval(tiempo_Real, 3000);
