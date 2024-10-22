document.addEventListener('DOMContentLoaded', () => {
    // URL de la API que devuelve los libros (ajusta esta URL a la real)
    const apiUrl = 'https://miapi.com/libros';

    // Contenedor donde se añadirán las tarjetas de libros
    const librosContainer = document.getElementById('libros');
    
    // Indicador de carga
    const loadingElement = document.getElementById('loading');

    // Función para crear cada tarjeta de libro de forma dinámica
    const createBookCard = (libro) => {
        const contenedorLibro = document.createElement('div');
        contenedorLibro.className = 'ContenedorLibro';

        // Estructura del contenido de la tarjeta
        contenedorLibro.innerHTML = `
            <h4 id="nombre-libro">${libro.titulo}</h4>
            <img src="${libro.imagen}" alt="Portada libro" />
            <p>Autor</p>
            <p id="autor">${libro.autor}</p>
            <p>Género</p>
            <p id="genero">${libro.genero}</p>
        `;

        return contenedorLibro;
    };

    const fetchWithTimeout = (url, options, timeout = 10000) => {
    return new Promise((resolve, reject) => {
        const timer = setTimeout(() => {
            reject(new Error('Tiempo de espera agotado'));
        }, timeout);

        fetch(url, options)
            .then(response => {
                clearTimeout(timer);
                resolve(response);
            })
            .catch(err => {
                clearTimeout(timer);
                reject(err);
            });
    });
};


    // Función para cargar los libros desde la API
    const loadBooks = async () => {
        let hasResponse = false; // Flag para controlar si se ha recibido respuesta

        try {
            // Mostrar el indicador de carga
            loadingElement.style.display = 'block';

            const response = await fetchWithTimeout(apiUrl, {}, 10000); // Timeout de 10 segundos

            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }

            const libros = await response.json();
            hasResponse = true; // Marca que hemos recibido una respuesta correcta

            // Limpiar el contenedor de libros por si hay contenido previo
            librosContainer.innerHTML = '';

            // Recorrer los libros y crear las tarjetas
            libros.forEach(libro => {
                const bookCard = createBookCard(libro);
                librosContainer.appendChild(bookCard);
            });
        } catch (error) {
           swal.fire({
               icon: 'error',
               title: 'Error',
               text: 'Error en la respuesta de la API',
               confirmButtonText: 'Aceptar'
           }).then(() => {
               // Ocultar el indicador de carga
               loadingElement.style.display = 'none';
           })
           
        } finally {
            // Solo ocultar el spinner si se recibió una respuesta exitosa
            if (hasResponse) {
                loadingElement.style.display = 'none';
            }
        }
    };

    // Llamar a la función para cargar los libros al cargar la página
    loadBooks();
});
