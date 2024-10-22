function mostrarImagen() {
    const tipo = document.getElementById('tipo').value;
    const imagenMaterial = document.getElementById('imagenMaterial');
    
    const imagenes = {
        libro: 'ruta/a/la/imagen_libro.jpg',
        video: 'ruta/a/la/imagen_video.jpg',
        juego: 'ruta/a/la/imagen_juego.jpg',
        software: 'ruta/a/la/imagen_software.jpg',
        manual: 'ruta/a/la/imagen_manual.jpg'
    };

    if (imagenes[tipo]) {
        imagenMaterial.src = imagenes[tipo];
        imagenMaterial.style.display = 'block';
    } else {
        imagenMaterial.src = '';
        imagenMaterial.style.display = 'none';
    }
}

function vaciarFormulario() {
    document.getElementById('formMaterial').reset();
    document.getElementById('imagenMaterial').src = '';
    document.getElementById('imagenMaterial').style.display = 'none';
}
