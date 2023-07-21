<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

try {

    (new Tipo())->insert(
        $postData['nombre'],
        $postData['descripcion']
    );

     header('Location: ../index.php?link=admin_tipo');

} catch (Exception $e){
    echo "<p>No se pudo cargar el tipo</p>";
}