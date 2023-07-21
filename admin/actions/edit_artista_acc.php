<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['imagen'];

$id = $_GET['id'] ?? FALSE;

// echo "<pre>";
// print_r($postData);
// echo "</pre>";

// echo "<pre>";
// print_r($fileData);
// echo "</pre>";


try {

    $artista = (new Artista)->get_por_id($id);

    if(!empty($fileData['tmp_name'])){
        //el usuario decidio reemplazar la imagen

        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/artistas", $fileData);
        (new Imagen())->eliminarImagen(__DIR__ . "/../../img/artistas/" . $postData['imagen_original']);

    } else {

        $imagen = $postData['imagen_original'];
        //el usuario decidio quedarse con la imagen original
    }

    $artista->edit(
        $postData['nombre'],
        $postData['descripcion'],
        $imagen
    );

    header('Location: ../index.php?link=admin_artistas');

} catch (Exception $e){
    echo "<p>No se pudo editar el artista</p>";
}