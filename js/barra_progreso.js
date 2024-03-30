// barra_progreso.js

document.addEventListener('DOMContentLoaded', function() {
    const inputRange = document.getElementById('nochesInput');
    const precioNoches = document.getElementById('precioNoches');

    inputRange.addEventListener('input', () => {
        const valorNoches = inputRange.value;
        const precioTotal = valorNoches * 25;
        precioNoches.textContent = `${precioTotal} €`;
    });
});