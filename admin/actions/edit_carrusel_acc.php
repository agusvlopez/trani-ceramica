<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['img'];

$id = $_GET['id'] ?? FALSE;

// echo "<pre>";
// print_r($postData);
// echo "</pre>";

 echo "<pre>";
 print_r($postData['imagen_original']['img_1']);
 echo "</pre>";

$imagenes = ($postData['imagen_original']);

 foreach($imagenes as $key => $value) {
    echo "<pre>";
    print_r($key);
    echo "</pre>";
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

try {

    $carrusel = (new Carrusel)->get_por_id($id);

    if(!empty($fileData['tmp_name'][0])){

        echo "<pre>";
        print_r($fileData);
        echo "<pre>";
        //el usuario decidio reemplazar la imagen
        $filePrimerName = $fileData['name'][0];
        $filePrimerFP = $fileData['full_path'][0];
        $filePrimerType = $fileData['type'][0];
        $filePrimerTN = $fileData['tmp_name'][0];
        $filePrimerSize = $fileData['size'][0];

        $arrayPrimerFile = [
            "name" => $filePrimerName,
            "full_path" =>  $filePrimerFP,
            "type" => $filePrimerType,
            "tmp_name" => $filePrimerTN,
            "size" =>  $filePrimerSize
        ];

        $primera_imagen_original = $postData['imagen_original'][0];

        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/carrusel",  $arrayPrimerFile);
        (new Imagen())->eliminarImagen(__DIR__ . "/../../img/carrusel/" . $primera_imagen_original);

    }else {

        $imagen = $primera_imagen_original;
    }

    if(!empty($fileData['tmp_name'][1])){

        $arraySegundoFile = [
            "name" => $fileData['name'][1],
            "full_path" =>  $fileData['full_path'][1],
            "type" => $fileData['type'][1],
            "tmp_name" => $fileData['tmp_name'][1],
            "size" =>  $fileData['size'][1]
        ];

        echo "<pre>";
        print_r($arraySegundoFile);
        echo "<pre>";

        $segunda_imagen_original = $postData['imagen_original'][1];

        $imagen2 = (new Imagen())->subirImagen(__DIR__ . "/../../img/carrusel",  $arraySegundoFile);
        (new Imagen())->eliminarImagen(__DIR__ . "/../../img/carrusel/" . $segunda_imagen_original);
    }else {

        $imagen2 = $segunda_imagen_original;
    }
    
    if(!empty($fileData['tmp_name'][2])){

        $arrayTercerFile = [
            "name" => $fileData['name'][2],
            "full_path" =>  $fileData['full_path'][2],
            "type" => $fileData['type'][2],
            "tmp_name" => $fileData['tmp_name'][2],
            "size" =>  $fileData['size'][2]
        ];

        echo "<pre>";
        print_r($arraySegundoFile);
        echo "<pre>";
        
        $tercera_imagen_original = $postData['imagen_original'][2];
        $imagen3 = (new Imagen())->subirImagen(__DIR__ . "/../../img/carrusel",  $arrayTercerFile);
        (new Imagen())->eliminarImagen(__DIR__ . "/../../img/carrusel/" . $tercera_imagen_original);
    }else {

        $imagen3 = $tercera_imagen_original;
    }

    $carrusel->edit(
        $imagen,
        $imagen2,
        $imagen3,
        $postData['alt1'],
        $postData['alt2'],
        $postData['alt3']
    );

    //header('Location: ../index.php?link=admin_carrusel');

} catch (Exception $e){
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    echo "<p>No se pudo editar el carrusel</p>";
}
