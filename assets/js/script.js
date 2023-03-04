const detallesButtons = document.querySelectorAll('.detalles-btn');
const detallesCodigo = document.querySelector('#detalles-codigo');
const detallesNombre = document.querySelector('#detalles-nombre');
const detallesDescripcion = document.querySelector('#detalles-descripcion');
const detallesCategoria = document.querySelector('#detalles-categoria');
const detallesPrecio = document.querySelector('#detalles-precio');
const detallesExistencias = document.querySelector('#detalles-existencias');
const detallesEstado = document.querySelector('#detalles-estado');

detallesButtons.forEach(button => {
    button.addEventListener('click', () => {
        detallesCodigo.textContent = button.getAttribute('data-codigo');
        detallesNombre.textContent = button.getAttribute('data-nombre');
        detallesDescripcion.textContent = button.getAttribute('data-descripcion');
        detallesCategoria.textContent = button.getAttribute('data-categoria');
        detallesPrecio.textContent = button.getAttribute('data-precio');
        detallesExistencias.textContent = button.getAttribute('data-existencias');
        if(button.getAttribute('data-existencias') == 0){
            detallesEstado.textContent = "Producto NO Disponible";
        }else{
            detallesEstado.textContent = "Producto Disponible";
        }
    });
});