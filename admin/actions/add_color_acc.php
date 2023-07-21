<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

try {

    (new Color())->insert(
        $postData['nombre']
    );

     header('Location: ../index.php?link=admin_color');

} catch (Exception $e){
    echo "<p>No se pudo cargar el personaje</p>";
}