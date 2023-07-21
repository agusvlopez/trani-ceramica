<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

try {

    $tipo = (new Tipo)->get_por_id($id);

    $tipo->edit(
        $postData['nombre'],
        $postData['descripcion']   
    );

    header('Location: ../index.php?link=admin_tipo');

} catch (Exception $e){
    echo "<p>No se pudo editar el Tipo</p>";
}