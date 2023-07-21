<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

try {

    $tamanio = (new Tamanio)->get_por_id($id);

    $tamanio->edit(
        $postData['nombre_medida'],
        $postData['descripcion_medida']   
    );

    header('Location: ../index.php?link=admin_tamanio');

} catch (Exception $e){
    echo "<p>No se pudo editar el Tamaño</p>";
}