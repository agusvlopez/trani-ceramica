<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $coleccion = (new Coleccion())->get_por_id($id);
    $coleccion->delete();
    header('Location: ../index.php?link=admin_coleccion');
} catch (Exception $e){
   die("No se pudo eliminar la coleccion");
}