<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $color = (new Color())->get_por_id($id);
    $color->delete();
    header('Location: ../index.php?link=admin_color');
} catch (Exception $e){
   die("No se pudo eliminar el color");
}