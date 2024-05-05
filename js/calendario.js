document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los botones de días del calendario
    var botonesDia = document.querySelectorAll(".dia");

    // Iterar sobre cada botón de día
    botonesDia.forEach(function(btn) {
        // Agregar un evento de clic a cada botón
        btn.addEventListener("click", function() {
            // Cambiar el estado de disponibilidad del día
            if (this.classList.contains("disponible")) {
                this.classList.remove("disponible");
                this.classList.add("no-disponible");
                // Aquí puedes enviar la información de disponibilidad al servidor utilizando AJAX
            } else {
                this.classList.remove("no-disponible");
                this.classList.add("disponible");
                // Aquí puedes enviar la información de disponibilidad al servidor utilizando AJAX
            }
        });
    });
});
