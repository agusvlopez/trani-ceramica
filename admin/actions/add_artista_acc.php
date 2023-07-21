<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['imagen'];

echo "<pre>";
print_r($postData);
echo "</pre>";

// echo "<pre>";
// print_r($fileData);
// echo "</pre>";


try {

    $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/artistas", $fileData);
    
    (new Artista())->insert(
        $postData['nombre'],
        $postData['descripcion'],
        $imagen
    );
    // // echo "<p>Se cargo el personaje correctamente</p>";
     header('Location: ../index.php?link=admin_artistas');

} catch (Exception $e){
    echo "<p>No se pudo cargar el personaje</p>";
}