document.addEventListener('DOMContentLoaded', function() {
    // Detectamos si estamos en un formulario de película o de cliente
    const fileInput = document.getElementById('portada') || document.getElementById('foto');
    const dropZone = document.getElementById('dropZone');
    const preview = document.getElementById('imagePreview');

    if (!fileInput || !dropZone) return;

    // Prevenir comportamiento por defecto
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    // Añadir efectos visuales al arrastrar
    dropZone.addEventListener('dragover', () => { 
        dropZone.style.borderColor = 'var(--gold)'; 
        dropZone.style.background = 'var(--surface2)'; 
    });
    
    dropZone.addEventListener('dragleave', () => { 
        dropZone.style.borderColor = 'var(--border2)'; 
        dropZone.style.background = 'var(--bg3)'; 
    });

    // Manejar el drop
    dropZone.addEventListener('drop', (e) => {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFiles(files);
        }
    }, false);

    // Click en la zona abre el selector
    dropZone.addEventListener('click', () => fileInput.click());

    // Input tradicional
    fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

    function handleFiles(files) {
        if (files.length === 0) return;
        const file = files[0];
        
        if (!file.type.startsWith('image/')) {
            alert('Por favor, selecciona una imagen válida');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: var(--radius-sm); margin-top: 15px; border: 1px solid var(--gold);">
            `;
        };
        reader.readAsDataURL(file);
    }

    function handleFiles(files) {
        if (files.length === 0) return;
        const file = files[0];
        
        if (!file.type.startsWith('image/')) {
            alert('Por favor, selecciona una imagen válida');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            // Añadimos feedback visual de éxito
            dropZone.innerHTML = `
                <div style="color: var(--green); font-size: 2rem;">✓</div>
                <div style="color: var(--text); font-size: 0.9rem;">${file.name}</div>
            `;
            dropZone.style.borderColor = 'var(--green)';
            
            // Si quieres mantener la previsualización, puedes añadirla aquí también:
            const preview = document.getElementById('imagePreview');
            if (preview) {
                preview.innerHTML = `<img src="${e.target.result}" style="max-width: 100px; margin-top: 10px; border-radius: 4px;">`;
            }
        };
        reader.readAsDataURL(file);
    }
});