document.addEventListener('DOMContentLoaded', function() {
    // Selecciona los botones SVG por su ID
    var menuUsuarioBtn = document.getElementById('menu-usuario-btn');
    var menuLineasBtn = document.getElementById('menu-lineas-btn');
    var menuDesplegable = document.getElementById('menu-desplegable');

    // Agrega un evento de clic a cada botón para activar/desactivar el menú desplegable
    menuUsuarioBtn.addEventListener('click', toggleMenuDesplegable);
    menuLineasBtn.addEventListener('click', toggleMenuDesplegable);

    // Función para alternar la visibilidad del menú desplegable
    function toggleMenuDesplegable() {
        menuDesplegable.classList.toggle('activo');
    }
});