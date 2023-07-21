<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $tipo = (new Tipo())->get_por_id($id);
    $tipo->delete();
    header('Location: ../index.php?link=admin_tipo');
} catch (Exception $e){
   die("No se pudo eliminar el tamaño");
}