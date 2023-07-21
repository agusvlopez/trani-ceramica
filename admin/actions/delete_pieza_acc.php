<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $pieza = (new Pieza())->pieza_por_id($id);
    $pieza->vaciar_colores_secundarios();

    $pieza->delete();

    (new Alerta())->add_alerta('danger', "La pieza <strong>" . $pieza->getNombre() ."</strong> se eliminó correctamente");
    header('Location: ../index.php?link=admin_piezas');
} catch (Exception $e){
   die("No se pudo eliminar la pieza");
}