//
// Realizar todas las funciones en ECMAScript 6 (ES6)
//

// Verifica que el correo sea del dominio de la institución
const validarCorreo = () => {
  const correo = document.getElementById('correo').value;
  const dominioPermitido = 'fucsalud.edu.co';
  const errorMessage = document.getElementById('error-message');

  if (correo.endsWith(`@${dominioPermitido}`)) {
      errorMessage.textContent = ''; // Borra el mensaje de error si es válido
  } else {
      errorMessage.textContent = 'Por favor, ingrese un correo institucional';
  }
  
};
/*
// Agrega el script para mostrar/ocultar el menú en dispositivos móviles con animación
$(document).ready(function() {
  $(".navbar-toggler").on("click", function() {
    $("#navbarSupportedContent").toggleClass("show");
    // Cambia la posición del menú al hacer clic en el botón del menú
    if ($("#navbarSupportedContent").hasClass("show")) {
      $("#navbarSupportedContent").css("right", "0");
    } else {
      $("#navbarSupportedContent").css("right", "-100%");
    }
  });
});
*/
function goBack() {
  // Utiliza la función history.back() para ir atrás en la historia del navegador
  window.history.back();
}