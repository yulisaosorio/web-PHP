//declara variables 
cover_video= document.getElementById("ctn-cover-video");


//funciones
function mostar_video(){
	cover_video.style.display="flex";
}
function ocultar_video(){
	cover_video.style.display="none";
}

document.getElementById("btn-video").addEventListener("click",mostar_video);
document.getElementById("cerrar-video").addEventListener("click",ocultar_video);