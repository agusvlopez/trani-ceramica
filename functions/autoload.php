<?PHP 
session_start();
function autoload_classes($nombreClase){
    
//se aplica ruta absoluta
    //el __DIR__ me da la ruta absoluta de la carpeta functions...
    $archivoClase = __DIR__ . "/../classes/$nombreClase.php"; ;
    // echo "<p>RUTA: $archivoClase</p>";

    if(file_exists($archivoClase)){
        require_once $archivoClase;
    }else{
        die("No se pudo cargar la clase $nombreClase");
    }
    
}

//cuando se solicita una clase no incluida, va a ejecutar esta funcion...

spl_autoload_register('autoload_classes');