<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;

try {

    $color = (new Color)->get_por_id($id);

    $color->edit(
        $postData['nombre']
       
    );

    header('Location: ../index.php?link=admin_color');

} catch (Exception $e){
    echo "<p>No se pudo editar el artista</p>";
}