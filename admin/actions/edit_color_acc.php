<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

try {

    $color = (new Color)->get_por_id($id);

    $color->edit(
        $postData['nombre']
       
    );

    (new Alerta())->add_alerta('success', "El color <strong>{$postData['nombre']}</strong> se editó correctamente");
    header('Location: ../index.php?link=admin_color');

} catch (Exception $e){
    (new Alerta())->add_alerta('danger', "El color <strong>{$postData['nombre']}</strong> no se pudo editar correctamente. Por favor intente más tarde.");
    header('Location: ../index.php?link=admin_color');
}