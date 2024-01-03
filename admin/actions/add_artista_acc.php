<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['imagen'];

try {

    $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/artistas", $fileData);
    
    (new Artista())->insert(
        $postData['nombre'],
        $postData['descripcion'],
        $imagen
    );
    (new Alerta())->add_alerta('success', "El/la artista <strong>" . $postData['nombre'] ."</strong> se agregó correctamente");
     header('Location: ../index.php?link=admin_artistas');

} catch (Exception $e){
    echo "<p>No se pudo cargar el personaje</p>";
}