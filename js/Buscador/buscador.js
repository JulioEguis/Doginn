/*
    Este bloque de código utiliza jQuery para habilitar la función de autocompletado
    en el campo de ubicación del formulario de búsqueda.

    - Se define un array llamado "availableCities" que contiene una lista de ciudades disponibles.
    - Se selecciona el campo de entrada de ubicación utilizando el selector de jQuery "#location".
    - Se llama al método "autocomplete" de jQuery UI en el campo de entrada de ubicación.
    - Se proporciona una función como valor de la propiedad "source", que se activa cada vez
    que se necesita obtener la lista de opciones para el autocompletado.
    - Dentro de esta función:
        - Se utiliza la función "grep" de jQuery para filtrar las ciudades disponibles
        que coincidan con el término de búsqueda ingresado por el usuario.
        - Se llama a la función de respuesta "response" con la lista filtrada de ciudades.
*/


$(function() {
    var availableCities = [
        "Madrid", "Barcelona", "Valencia", "Sevilla", "Zaragoza", "Málaga", "Murcia", "Palma de Mallorca",
        "Las Palmas de Gran Canaria", "Bilbao", "Alicante", "Córdoba", "Valladolid", "Vigo", "Gijón", "L'Hospitalet de Llobregat",
        "La Coruña", "Granada", "Vitoria", "Elche", "Santa Cruz de Tenerife", "Oviedo", "Badalona", "Cartagena",
        "Terrassa", "Jerez de la Frontera", "Sabadell", "Móstoles", "Alcalá de Henares", "Fuenlabrada", "Almería",
        "Leganés", "Santander", "Castellón de la Plana", "Burgos", "Albacete", "Getafe", "Alcorcón", "San Cristóbal de La Laguna",
        "Logroño", "Badajoz", "Salamanca", "Huelva", "Marbella", "Lérida", "Tarragona", "Dos Hermanas", "Torrejón de Ardoz",
        "Parla", "Mataró", "León", "Algeciras", "Santa Coloma de Gramenet", "Cádiz", "Jaén", "Orense", "Reus",
        "Telde", "Baracaldo", "Lugo", "Gerona", "Pontevedra", "Toledo", "El Ejido", "Chiclana de la Frontera", "Ceuta",
        "Manresa", "Torrente", "Ciudad Real", "Melilla", "Guadalajara", "Orihuela", "Marín", "Puerto del Rosario", "Pozuelo de Alarcón",
        "Sagunto", "Santiago de Compostela", "San Sebastián de los Reyes", "Cornellá de Llobregat", "Avilés", "Ibiza", "Figueras",
        "Talavera de la Reina", "Benidorm", "Arrecife", "Segovia", "Torrevieja", "Moncloa-Aravaca", "Ferrol", "Coslada", "Valdemoro",
        "Rivas-Vaciamadrid", "Alcalá de Guadaíra", "Ponferrada", "Zamora", "Paterna", "Fuengirola", "Viladecans", "Mijas", "Alcobendas",
        "Sanlúcar de Barrameda", "El Puerto de Santa María", "Estepona", "Torremolinos", "La Línea de la Concepción", "Granollers", "Cáceres",
        "Motril", "Ávila", "Cerdanyola del Vallès", "Las Rozas de Madrid", "Segundo Ensanche", "Aranda de Duero", "Manlleu", "Ciempozuelos",
        "Parets del Vallès", "Tomares", "Carmona", "Molina de Segura", "Pinto", "Rentería", "Lebrija", "San Bartolomé", "Elda",
        "Olot", "San Fernando", "Vic", "San Juan de Aznalfarache", "Gavá", "Siero", "Esplugas de Llobregat", "Eibar", "Lalin",
        "Gernika-Lumo", "Irún", "Bermeo", "Barberá del Vallés", "Torrejón de la Calzada", "Ripollet", "Ermua", "Zalla", "Muxika",
        "Galdácano", "Crevillente", "Basauri", "Arnedo", "Azpeitia", "Sant Adrià de Besòs", "Sant Feliu de Guíxols", "Arteijo", "Castro-Urdiales",
        "San Andrés del Rabanedo", "Zafra", "Villaviciosa de Odón", "Santurtzi", "San Lorenzo del Escorial", "Roses", "S"
    ];

    $("#location").autocomplete({
        source: function(request, response) {
            var filteredCities = $.grep(availableCities, function(city) {
                return city.toLowerCase().startsWith(request.term.toLowerCase());
            });
            response(filteredCities);
        }
    });
});
