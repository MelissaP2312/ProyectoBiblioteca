document.addEventListener('DOMContentLoaded', () => {
    // URL de la API que devuelve los temas (ajusta según tu API)
    const apiUrl = 'https://miapi.com/temas';

    // Elemento donde se añadirán los temas
    const topicsList = document.getElementById('topics-list');

    // Función para crear cada tema de forma dinámica
    const createTopicItem = (topic) => {
        const li = document.createElement('li');
        const topicLink = document.createElement('a');
        const topicMeta = document.createElement('p');

        // Configurar el enlace
        topicLink.href = topic.url;  // El enlace viene desde la base de datos
        topicLink.textContent = topic.title;

        // Configurar la meta información
        topicMeta.className = 'topic-meta';
        topicMeta.textContent = `Creado por ${topic.creator} - ${topic.responses} respuestas`;

        // Agregar los elementos al <li>
        li.appendChild(topicLink);
        li.appendChild(topicMeta);

        // Retornar el <li> completo
        return li;
    };

    // Función para cargar los temas desde la API
    const loadTopics = async () => {
        try {
            const response = await fetch(apiUrl);
            const topics = await response.json();

            // Limpiar la lista actual (por si hubiera algún contenido previo)
            topicsList.innerHTML = '';

            // Recorrer los temas y agregarlos a la lista
            topics.forEach(topic => {
                const topicItem = createTopicItem(topic);
                topicsList.appendChild(topicItem);
            });
        } catch (error) {
            console.error('Error al cargar los temas:', error);
        }
    };

    // Llamada para cargar los temas al cargar la página
    loadTopics();
});
