$(document).ready(function () {
    $('.temporizador').each(function () {
        const ciudad = $(this).data('ciudad');
        const tiempo = $(this).data('tiempo');
        const tiempoInicial = parseInt(tiempo, 10);
        const $temporizador = $(this);

        function actualizarTemporizador() {
            if (tiempoInicial > 0) {
                const segundos = tiempoInicial % 60;
                const minutos = Math.floor((tiempoInicial / 60) % 60);
                const horas = Math.floor(tiempoInicial / 3600);

                let color = 'green'; // Color verde por defecto

                if (tiempoInicial <= 3600) {
                    color = 'yellow'; // Cambiar a amarillo cuando quede 1 hora o menos
                }

                if (tiempoInicial <= 0) {
                    $temporizador.text('CASO VENCIDO').css('color', 'red'); // Cambiar a color rojo y mostrar "CASO VENCIDO" cuando se agote el tiempo
                } else {
                    $temporizador.text(`${horas}h ${minutos}m ${segundos}s`).css('color', color);
                }

                tiempoInicial--;
            }
        }

        actualizarTemporizador();
        setInterval(actualizarTemporizador, 1000); // Actualizar el temporizador cada segundo
    });
});