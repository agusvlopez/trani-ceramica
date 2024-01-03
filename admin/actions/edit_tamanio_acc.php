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

    (new Alerta())->add_alerta('success', "El tamaño <strong>{$postData['nombre_medida']}</strong> se editó correctamente");
    header('Location: ../index.php?link=admin_tamanio');

} catch (Exception $e){
    (new Alerta())->add_alerta('danger', "El tamaño <strong>{$postData['nombre']}</strong> no se pudo editar correctamente. Por favor intente más tarde.");
    header('Location: ../index.php?link=admin_tamanio');
}