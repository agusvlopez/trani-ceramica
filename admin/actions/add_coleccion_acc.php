<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

echo "<pre>";
print_r($postData);
echo "</pre>";

try {

    (new Coleccion())->insert(
        $postData['nombre_coleccion'],
        $postData['descripcion_coleccion']
    );
    // // echo "<p>Se cargo el personaje correctamente</p>";
     header('Location: ../index.php?link=admin_coleccion');

} catch (Exception $e){
    echo "<p>No se pudo cargar el personaje</p>";
}