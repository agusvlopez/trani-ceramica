<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

try {

    (new Tamanio())->insert(
        $postData['nombre_medida'],
        $postData['descripcion_medida']
    );

     header('Location: ../index.php?link=admin_tamanio');

} catch (Exception $e){
    echo "<p>No se pudo cargar el tamaño</p>";
}