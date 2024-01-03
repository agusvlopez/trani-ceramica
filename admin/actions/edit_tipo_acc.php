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

    (new Alerta())->add_alerta('success', "El tipo de pieza <strong>{$postData['nombre']}</strong> se editó correctamente");
    header('Location: ../index.php?link=admin_tipo');

} catch (Exception $e){
        (new Alerta())->add_alerta('danger', "El tipo de pieza <strong>{$postData['nombre']}</strong> no se pudo editar correctamente. Por favor intente más tarde.");
    header('Location: ../index.php?link=admin_tipo');
}