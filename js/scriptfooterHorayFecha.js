function updateDateTime() {
    const now = new Date();
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    };
    document.getElementById('dateTime').textContent = now.toLocaleString('es-ES', options);
}

setInterval(updateDateTime, 1000); // Actualiza cada segundo
updateDateTime(); // Llama la función al cargar
