<?PHP
require_once "../../functions/autoload.php";


$postData = $_POST;
$fileData = $_FILES['imagen'];

// me aparece dos veces el dato de la imagen >>
    echo "<pre>";
    print_r($postData);
    echo "</pre>";

//  echo "<pre>";
//  print_r($_FILES);
//  echo "</pre>";


try {    
    $pieza = new Pieza();
    $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/covers", $fileData);

    $idPieza = $pieza->insert(
        $postData['titulo'], 
        $postData['tipo_id'], 
        $postData['artista_id'], 
        $postData['descripcion'], 
        $postData['tamanio_id'], 
        $postData['color_id'], 
        $postData['precio'], 
        $postData['coleccion_id'], 
        $postData['publicacion'], 
        $imagen,

     
    );
      var_dump($idPieza);
      $tipo_id = $postData['tipo_id'];
    if (isset($postData['colores_de_piezas'])) {
        foreach ($postData['colores_de_piezas'] as $c_id) {
            $pieza->add_colores(intval($idPieza), intval($tipo_id), intval($c_id));
        }
    }

    
    (new Alerta())->add_alerta('success', "La pieza <strong>{$postData['titulo']}</strong> se cargó correctamente");
    header('Location: ../index.php?link=admin_piezas');

} catch (Exception $e) {
    // header('Location: ../index.php?link=admin_piezas');
    echo "<pre>";
    print_r($e->getMessage());
    echo "</pre>";
    (new Alerta())->add_alerta('danger', "Ocurrió un error inesperado, por favor pongase en contacto con el administrador de sistema.");
}