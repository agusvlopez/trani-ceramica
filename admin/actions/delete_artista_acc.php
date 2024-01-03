<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $artista = (new Artista())->get_por_id($id);
    $artista->delete();
    (new Alerta())->add_alerta('danger', "El/la artista <strong>" . $artista->getNombre() ."</strong> se eliminó correctamente");
    header('Location: ../index.php?link=admin_artistas');
} catch (Exception $e){
   die("No se pudo eliminar el artista");
}