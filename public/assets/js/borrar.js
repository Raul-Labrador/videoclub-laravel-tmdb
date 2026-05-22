document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('destroyModal');
  const form    = document.getElementById('form-delete');

  if (!overlay || !form) return;

  // Seleccionamos todos los enlaces de borrado
  document.querySelectorAll('.link-destroy').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      
      const url = btn.getAttribute('data-href');
      if (url) {
          form.action = url; // Asignamos la ruta al formulario
          overlay.classList.add('active'); // Mostramos el modal
      } else {
          console.error("No se encontró el atributo data-href en el botón de borrar");
      }
    });
  });
});

function closeModal() {
  const overlay = document.getElementById('destroyModal');
  if (overlay) overlay.classList.remove('active');
}