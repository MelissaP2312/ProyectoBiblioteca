function previewImage(event) {
    const imagePreview = document.getElementById('imagenPreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

function clearForm() {
    document.getElementById('formLibro').reset();
    document.getElementById('imagenPreview').style.display = 'none';
}
