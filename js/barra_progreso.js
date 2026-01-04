document.addEventListener('DOMContentLoaded', function() {
    const inputRange = document.getElementById('nochesInput');
    const precioTotal = document.getElementById('precioTotal');
    const precioNoches = document.getElementById('precioNoches');

    // Función para actualizar el precio total y el número de noches seleccionadas cuando el usuario mueve la barra
    function actualizarPrecio() {
        const valorNoches = inputRange.value;
        const precioPorNoche = 25;
        const total = valorNoches * precioPorNoche;
        precioNoches.textContent = `Precio total: ${total}€`;
        precioTotal.textContent = `${valorNoches} noches a unos 25 € por noche`;
    }

    // Actualizar el precio total al cargar la página
    actualizarPrecio();

    // Agregar el evento input para actualizar el precio total y el número de noches al mover la barra
    inputRange.addEventListener('input', function() {
        actualizarPrecio();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const tituloCalculo = document.querySelector('h1');

    // Agregar subrayado al texto
    tituloCalculo.style.textDecoration = 'underline';

    // Agregar evento para abrir una ventana con el texto cuando se hace clic en el título
    tituloCalculo.addEventListener('click', function() {
        mostrarVentana();
    });
});

// Función para mostrar la ventana con el texto
function mostrarVentana() {
    const textoVentana = `Cómo calculamos tus ingresos potenciales\n\nPara calcular cuánto podrías ganar, analizamos los datos de las reservas de los últimos 12 meses en anuncios similares al tuyo, que elegimos teniendo en cuenta la información que has proporcionado sobre tu alojamiento. Si indicas la dirección, la estimación que obtendrás estará basada específicamente en anuncios de espacios cercanos al tuyo. Y si indicas una zona, partiremos del 50 % que genera más ingresos dentro de los que son similares en dicha área.\n\nEn función de esa selección, calculamos el promedio de ingresos por noche y lo multiplicamos por la cantidad de noches que quieres recibir huéspedes. También calculamos el promedio mensual de noches reservadas en esa zona, partiendo de la base de que los alojamientos están disponibles para reservar en Airbnb el mes entero. Te recordamos que los ingresos por noche son el precio que establece el anfitrión menos la comisión de servicio para anfitriones que cobra Airbnb, sin restar impuestos o gastos relativos al hospedaje.\n\nTus ingresos reales dependerán de varios factores, como tu disponibilidad, tus precios y la demanda que haya en tu zona. Además, la legislación local también podría influir en el desarrollo de tu actividad. En esta página tienes más detalles sobre cómo ser un anfitrión responsable.\n\nLos cálculos de ingresos no constituyen una estimación o tasación del valor de la propiedad.`;

    // Abrir una ventana con el texto
    window.alert(textoVentana);
}
