<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $artista = (new Artista())->get_por_id($id);
    $artista->delete();
    // echo "<p>Se cargo el artista correctamente</p>";
    header('Location: ../index.php?link=admin_artistas');
} catch (Exception $e){
   die("No se pudo eliminar el artista");
}