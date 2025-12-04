{{-- Jose Abian Diaz Santana --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen UT3</title>
</head>
<body>
    <h1>Formulario de Alta de Asistentes</h1>

    {{-- Feedback al usuario (Mensaje éxito) --}}
    <!-- session('nombre') obtiene el valor de la sesión que fue pasado por el controlador tras el almacenamiento -->
    @if (session('nombre'))
         <!-- Párrafo que muestra el nombre correctamente -->
        <p> Gracias {{ session('nombre') }} tu inscripción ha sido procesada.</p>
    @endif

    <!-- session('edad') obtiene el valor de la sesión y lo comparamos con lo requerido en el ejercicio, si se cumple se ejecutara el mensaje de servicio no disponible temporalmente -->
    @if (session('edad') >= 18 && session('edad') <= 20)
        <p> Servicio temporalmente no disponible.</p>
    @endif
    
    <!-- Formulario HTML que envía datos al servidor mediante POST -->
    <!-- La acción del formulario apunta a la ruta 'inscription.store' usando la función route() -->
    <!-- route() genera automáticamente la URL correcta basada en el nombre de la ruta definida en web.php -->
    <form action="{{ route('inscription.store') }}" method="POST">
        
    @csrf

        <label for="nombre">Nombre del asistente: </label>
        <input type="text" id="nombre" name="nombre">
        <br><br>
        
        <label for="email">Email: </label>
        <input type="text" id="email" name="email">
        <br><br>
        
        <label for="edad">Edad: </label>
        <input type="number" id="edad" name="edad">
        <br><br>
        
        <!-- Elemento select (desplegable) para la categoría del producto -->
        <label for="tipo-entrada">Tipo de entrada:</label>
        <select id="tipo-entrada" name="tipo-entrada">
             <!-- Primera opción disponible: Presencial -->
            <option value="Presencial">Presencial</option>
             <!-- Primera opción disponible: Virtual -->
            <option value="Virtual">Virtual</option>
        </select>
        <br><br>
        
        <!-- Botón para enviar el formulario -->
        <!-- El atributo 'type="submit"' hace que al hacer clic, se envíe el formulario a la acción especificada -->
        <button type="submit">Registrar asistentes</button>
        <br><br>
    </form>

    <!-- Enlace de navegación que permite que nos permite volver a la página de inicio -->
    <!-- Utilizamos la función route() para generar la URL dinámica de la ruta 'inicio' -->
    <a href="{{ route('inicio') }}">Volver a inicio</a>
</body>
</html>
