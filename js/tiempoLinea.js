<script type="text/javascript">
	function e(q) {
    document.body.appendChild( document.createTextNode(q) );
    document.body.appendChild( document.createElement("BR") );
}
function inactividad() {
    e("Inactivo!!");
}
var t=null;
function contadorInactividad() {
    t=setTimeout("inactividad()",3000);
}
window.onblur=window.onmousemove=function() {
    if(t) clearTimeout(t);
    contadorInactividad();
}
</script>