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
        $postData['descripcion'],
       
    );

    header('Location: ../index.php?link=admin_coleccion');

} catch (Exception $e){
    echo "<p>No se pudo editar el artista</p>";
}