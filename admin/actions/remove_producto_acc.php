<?PHP 
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

if($id){
    (new Carrito())->eliminar_producto($id);
    header('location: ../../index.php?link=carrito');

}