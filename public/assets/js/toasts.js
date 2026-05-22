document.addEventListener('DOMContentLoaded', () => {
    // Buscamos los mensajes que Laravel inyecta en la vista
    const alerts = document.querySelectorAll('.alert');
    
    if (alerts.length > 0) {
        const container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);

        alerts.forEach(alert => {
            const toast = document.createElement('div');
            toast.className = `toast ${alert.classList.contains('alert-danger') ? 'toast-error' : 'toast-success'}`;
            toast.textContent = alert.textContent.replace('✓', '').replace('✕', '').trim();
            container.appendChild(toast);

            // Ocultamos el alert original para no duplicar
            alert.style.display = 'none';

            // Eliminar toast tras 5 segundos
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s';
                setTimeout(() => toast.remove(), 500);
            }, 5000);
        });
    }
});