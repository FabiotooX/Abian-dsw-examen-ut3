<?php
// Jose Abian Diaz Santana
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

// Definición de la clase InscriptionController que extiende Controller
// Al extender Controller, hereda métodos útiles
class InscriptionController extends Controller
{
    // Método create() que devuelve la vista del formulario de asignacion de asistentes
    // Este método es llamado cuando el usuario accede a la ruta GET /inscription/create
    // No recibe parámetros porque solo necesita devolver la vista del formulario vacío
    public function create()
    {
        // Utilizamos la función view() para devolver la vista 'inscription.create'
        // Esta vista contiene el formulario HTML con los campos para asignar nuevos asistentes
        return view('inscription.create');
    }
    
    // Método store() que procesa los datos recibidos del formulario
    // Este método es llamado cuando el usuario envía el formulario mediante POST a la ruta /inscription
    // Recibe como parámetro un objeto Request que contiene todos los datos del formulario
    public function store(Request $request)
    {
        // Utilizamos el método validate() de Request para validar los datos antes de procesarlos
        // Si la validación falla, Laravel automáticamente redirige al usuario con los errores
        // El parámetro es un array donde las claves son los nombres de los campos y los valores son las reglas
        $datosValidados = $request->validate([
            'nombre' => 'required|string|min:5|max:100',
            'email' => 'string|email',
            'edad' => 'numeric|min:18',
            'tipo-entrada' => 'required|in:Presencial,Virtual',
        ]);
        
        // Obtención de los datos del formulario usando el método input() de Request
        // Accedemos a cada campo del formulario validado para utilizarlo en el almacenamiento
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $edad = $request->input('edad');
        $tipoentrada = $request->input('tipo-entrada');

        // Construcción de la línea que se guardará en el archivo CSV
        // Utilizamos comillas dobles para encerrar cada campo, separadas por punto y coma
        $linea = '"' . $nombre . '";"' . $email . '";"' . $edad . '";"' . $tipoentrada . "\"\n";

        // Creamos la variable de mensaje de error para asi solamente tener que llamarla en caso de error
        $mensaje_error = "Temporalmente el servicio no está disponible.";

        // Guardado de la línea en el archivo CSV
        // storage_path('app/asistentes.csv') devuelve la ruta completa al archivo en la carpeta storage
        // file_put_contents() escriben contenido en un archivo
        // FILE_APPEND indica que queremos añadir contenido al final del archivo sin sobrescribir lo existente
        if($edad > 20){
            file_put_contents(storage_path('app/asistentes.csv'), $linea, FILE_APPEND);
        } else{
            return $mensaje_error;
        }
        
        // redirect()->route('inscription.create') redirige al usuario a la ruta 'inscription.create' (el formulario)
        // ->with('nombre', $nombre) pasa el nombre a la sesión
        // Cuando la página se recarga, la sesión está disponible en la vista y puede mostrar el mensaje de éxito
        // with() es útil para pasar datos que persisten solo una solicitud
        return redirect()->route('inscription.create')->with('nombre', $nombre);
    }
}