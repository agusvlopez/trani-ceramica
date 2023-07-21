<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['imagen'] ?? FALSE;

$id = $_GET['id'] ?? FALSE;

try {
    $tipo_id = $postData['tipo_id'];
    $pieza = (new Pieza())->pieza_por_id($id);


    $pieza->vaciar_colores_secundarios();
    echo "<pre>";
    print_r($pieza);
    echo "</pre>";

    if (isset($postData['colores_de_piezas'])) {
        foreach ($postData['colores_de_piezas'] as $c_id) {
            $pieza->add_colores($id, $tipo_id, $c_id);
        }
    }

    if (!empty($fileData['tmp_name'])) {
        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/covers", $fileData);
        (new Imagen())->eliminarImagen(__DIR__ . "/../../img/covers/" . $postData['imagen_original']);
    }else{
        $imagen = $postData['imagen_original'];
    }

    $pieza->edit(
        $postData['titulo'], 
        $postData['tipo_id'], 
        $postData['artista_id'], 
        $postData['tamanio_id'], 
        $postData['publicacion'], 
        $postData['descripcion'],
        $imagen,
        $postData['precio'],
        $postData['color_id'],  
        $postData['coleccion_id']

    );

    (new Alerta())->add_alerta('success', "La pieza <strong>{$postData['titulo']}</strong> se editó correctamente");
    header('Location: ../index.php?link=admin_piezas');


} catch (Exception $e){
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    echo "<p>No se pudo editar el artista</p>";
}