document.addEventListener('responseUpdated', function (event) {
    console.log("Evento recibido:", event.detail); // Verifica el contenido del evento
    const message = $("#responseTextarea");
    const responseText = event.detail.response || ""; // Valor por defecto si está undefined
    console.log("Texto recibido:", responseText);
    console.log("Texto actual:", message.text());

    const currentText = message.text();
    if (responseText.length >= currentText.length) {
        const newText = responseText.substring(currentText.length);
        typeMessage(newText);
    }
});


// Función para simular escritura
const typeMessage = (text, speed = 50) => {
    return new Promise((resolve) => {
        let i = 0;
        const message = $("#responseTextarea"); // Selecciona el textarea
        const interval = setInterval(() => {
            if (i < text.length) {
                message.text(message.text() + text[i]); // Agrega carácter por carácter
                i++;
                message.scrollTop(message[0].scrollHeight); // Asegura scroll hacia el final
            } else {
                clearInterval(interval);
                resolve();
            }
        }, speed);
    });
};
