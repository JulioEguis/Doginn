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
        console.log("Se ha hecho clic en un botón del menú.");
        menuDesplegable.classList.toggle('activo');

        // Si el menú está activo, ajusta la posición del menú desplegable para que aparezca debajo del botón
        if (menuDesplegable.classList.contains('activo')) {
            var rect = this.getBoundingClientRect(); // Obtiene la posición del botón clickeado
            menuDesplegable.style.top = rect.bottom + 'px'; // Establece la posición top del menú desplegable
            menuDesplegable.style.left = rect.left + 'px'; // Establece la posición left del menú desplegable
        }
    }
});
