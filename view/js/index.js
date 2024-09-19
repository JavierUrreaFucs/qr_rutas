//
// Realizar todas las funciones en ECMAScript 6 (ES6)
//

// Verifica que el correo sea del dominio de la institución
const validarCorreo = () => {
  let correo = document.getElementById('correo').value;
  let dominioPermitido = 'fucsalud.edu.co';
  let errorMessage = document.getElementById('error-message');

  if (correo.endsWith(`@${dominioPermitido}`)) {
      errorMessage.textContent = ''; // Borra el mensaje de error si es válido
  } else {
      errorMessage.textContent = 'Por favor, ingrese un correo institucional';
  }
  
};

// Utiliza la función history.back() para ir atrás en la historia del navegador
function goBack() {
  window.history.back();
}

// Función para mostrar el horario de la ruta de acuerdo al destino seleccionado
$(document).ready(function() {
  // Esta función se ejecuta cuando el documento está listo
  $("select[name=destino]").change(function() {
    // Esta función se ejecuta cuando el valor del select de destino cambia
    let destino = $(this).val(); // Obtenemos el valor seleccionado
    let horario = $("select[name=horario]"); // Obtenemos el elemento select de horario
    horario.empty(); // Vaciamos las opciones actuales
    horario.append("<option value=''>Selecione una opción</option>"); // Agregamos la opción por defecto
    if (destino == "Sede centro - Sede norte") {
      // Si el destino es Sede centro - Sede norte, agregamos las opciones correspondientes
      horario.append("<option value='1'>11:20 a.m.</option>");
      horario.append("<option value='2'>12:30 p.m.</option>");
    } else if (destino == "Sede norte - Sede centro") {
      // Si el destino es Sede norte - Sede centro, agregamos las opciones correspondientes
      horario.append("<option value='3'>12:00 m.</option>");
      horario.append("<option value='4'>1:10 p.m.</option>");
    }
  });
});

/**
 * Alerta de confirmación
 */
// Esperar a que el documento se cargue completamente
document.addEventListener('DOMContentLoaded', function() {
  // Agregar el listener a todos los formularios de eliminación
  document.querySelectorAll('.deleteForm').forEach(function(form) {
      form.addEventListener('submit', function(event) {
          let confirmation = confirm('¿Está seguro de que desea eliminar esta reserva?');
          if (!confirmation) {
              event.preventDefault(); // Evita que el formulario se envíe si el usuario cancela la confirmación
          }
      });
  });
  // Agregar el listener a todos los formularios de eliminación
  document.querySelectorAll('.cashForm').forEach(function(form) {
      form.addEventListener('submit', function(event) {
          let confirmation = confirm('¿Está seguro de realizar el pago de esta reserva?');
          if (!confirmation) {
              event.preventDefault(); // Evita que el formulario se envíe si el usuario cancela la confirmación
          }
      });
  });
});