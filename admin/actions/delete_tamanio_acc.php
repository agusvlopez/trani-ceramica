<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $tamanio = (new Tamanio())->get_por_id($id);
    $tamanio->delete();
    header('Location: ../index.php?link=admin_tamanio');
} catch (Exception $e){
   die("No se pudo eliminar el tamaño");
}