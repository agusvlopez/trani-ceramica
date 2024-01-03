<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

echo "<pre>";
print_r($postData);
echo "</pre>";


try {

    $coleccion = (new Coleccion)->get_por_id($id);

    $coleccion->edit(
        $postData['nombre_coleccion'],
        $postData['descripcion_coleccion'],
       
    );

    (new Alerta())->add_alerta('success', "La colección <strong>{$postData['nombre_coleccion']}</strong> se editó correctamente");
    header('Location: ../index.php?link=admin_coleccion');

} catch (Exception $e){
    (new Alerta())->add_alerta('danger', "La colección <strong>{$postData['nombre']}</strong> no se pudo editar. Por favor intente nuevamente más tarde.");
    header('Location: ../index.php?link=admin_coleccion');
}