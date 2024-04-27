// Pega aquí el código JavaScript de despegable.js
document.addEventListener('DOMContentLoaded', function() {
    var menuUsuarioBtn = document.getElementById('menu-usuario-btn');
    var menuLineasBtn = document.getElementById('menu-lineas-btn');
    var menuDesplegable = document.getElementById('menu-desplegable');

    menuUsuarioBtn.addEventListener('click', toggleMenuDesplegable);
    menuLineasBtn.addEventListener('click', toggleMenuDesplegable);

    function toggleMenuDesplegable() {
        console.log("Se ha hecho clic en un botón del menú.");
        menuDesplegable.classList.toggle('active');
    }
});