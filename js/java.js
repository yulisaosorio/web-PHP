// window.addEventListener("load", function () {
//   console.log("Cargó correctamente");
// });




// Slider destacados
const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider_section");
let sliderSectionLast = sliderSection[sliderSection.length - 1];

const btnLeft = document.querySelector("#btn_left");
const btnRight = document.querySelector("#btn_right");

slider.insertAdjacentElement("afterbegin", sliderSectionLast);

function moverDerecha() {
  let sliderSectionFirst = document.querySelectorAll(".slider_section")[0];
  slider.style.marginLeft = "-200%";
  slider.style.transition = "all 0.5s";
  setTimeout(function () {
    slider.style.transition = "none";
    slider.insertAdjacentElement("beforeend", sliderSectionFirst);
    slider.style.marginLeft = "-100%";
  }, 500);
}

btnRight.addEventListener("click", function () {
  moverDerecha();
});

function moverIzquierda() {
  let sliderSection = document.querySelectorAll(".slider_section");
  let sliderSectionLast = sliderSection[sliderSection.length - 1];
  slider.style.marginLeft = "0";
  slider.style.transition = "all 0.5s";
  setTimeout(function () {
    slider.style.transition = "none";
    slider.insertAdjacentElement("afterbegin", sliderSectionLast);
    slider.style.marginLeft = "-100%";
  }, 500);
}

btnLeft.addEventListener("click", function () {
  moverIzquierda();
});

setInterval(function(){
  moverDerecha();
},10000);





// BTN MENU en 768px
var hamburger = document.querySelector(".hamburger");
var wrapper = document.querySelector(".wrapper");
var backdrop = document.querySelector(".backdrop");

hamburger.addEventListener("click", function () {
  wrapper.classList.add("active");
});

backdrop.addEventListener("click", function () {
  wrapper.classList.remove("active");
});

// menu collapse
var li_items = document.querySelectorAll(".collap");
var collap = document.querySelector(".collapsed");
var expander = document.querySelector(".expander");
var vertical_bar = document.querySelector(".vertical_bar");
expander.addEventListener("click", function () {
  vertical_bar.classList.remove("hover_collapse");
  expander.style.display = "none";
  collap.style.display = "block";
});
collap.addEventListener("click", function () {
  vertical_bar.classList.add("hover_collapse");
  collap.style.display = "none";
  expander.style.display = "block";
});



// VENTANA MODAL
let cerrar = document.querySelectorAll(".close")[0];
let abrir = document.querySelectorAll(".cta")[0];
let modal = document.querySelectorAll(".modal")[0];
let modalC = document.querySelectorAll(".modal-container")[0];
let btn_cancelar = document.querySelectorAll(".btn_cancelar")[0];

abrir.addEventListener("click", function (e) {
  e.preventDefault(abrir);
  console.log()
  wrapper.style.filter = "blur(8px)";
  modalC.style.opacity = "1";
  modalC.style.visibility = "visible";
  modal.classList.toggle("modal-close");
});

cerrar.addEventListener("click", function () {
  modal.classList.toggle("modal-close");

  setTimeout(function () {
    wrapper.style.filter = "none";
    modalC.style.opacity = "0";
    modalC.style.visibility = "hidden";
  }, 850);
});

// BOTON CANCELAR
btn_cancelar.addEventListener("click", function (e) {
  modal.classList.toggle("modal-close");
  e.preventDefault();
  setTimeout(function () {
    wrapper.style.filter = "none";
    modalC.style.opacity = "0";
    modalC.style.visibility = "hidden";
  }, 850);
});

window.addEventListener("click", function (e) {
  // console.log(e.target);
  if (e.target == modalC) {
    modal.classList.toggle("modal-close");

    setTimeout(function () {
      wrapper.style.filter = "none";
      modalC.style.opacity = "0";
      modalC.style.visibility = "hidden";
    }, 900);
  }
});

// Previsualizar portada noticias
document.getElementById("portada").addEventListener("change", () => {
  var archivoseleccionado = document.querySelector("#portada");
  var archivos = archivoseleccionado.files;
  var imagenPrevisualizacion = document.querySelector("#previsualizar_portada");
  // Si no hay archivos salimos de la función y quitamos la imagen
  if (!archivos || !archivos.length) {
    imagenPrevisualizacion.src = "";
    return;
  }
  // Ahora tomamos el primer archivo, el cual vamos a previsualizar
  var primerArchivo = archivos[0];
  // Lo convertimos a un objeto de tipo objectURL
  var objectURL = URL.createObjectURL(primerArchivo);
  // Y a la fuente de la imagen le ponemos el objectURL
  imagenPrevisualizacion.src = objectURL;
});

















