document.addEventListener("DOMContentLoaded", function() {
    var registroGuarderia = document.querySelector('.registro-guarderia');

    registroGuarderia.addEventListener('mouseenter', function() {
        registroGuarderia.style.color = '#ff0000'; // Cambia el color del texto al pasar el ratón al color primario
    });

    registroGuarderia.addEventListener('mouseleave', function() {
        registroGuarderia.style.color = 'black'; // Restaura el color original al quitar el ratón
    });
});

