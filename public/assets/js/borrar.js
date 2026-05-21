/**
 * borrar.js
 * Gestiona el modal de confirmación de eliminación.
 * No depende de Bootstrap.
 */

document.addEventListener('DOMContentLoaded', () => {

  const overlay = document.getElementById('destroyModal');
  const form    = document.getElementById('form-delete');

  if (!overlay || !form) return;

  // Abrir modal al hacer clic en cualquier .link-destroy
  document.querySelectorAll('.link-destroy').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      form.action = btn.dataset.href;
      overlay.classList.add('active');
    });
  });

  // Cerrar al hacer clic en el overlay (fuera del modal)
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeModal();
  });

  // Cerrar con Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });
});

function closeModal() {
  const overlay = document.getElementById('destroyModal');
  if (overlay) overlay.classList.remove('active');
}