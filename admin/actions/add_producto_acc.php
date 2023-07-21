<?PHP 
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;
$c = $_GET['c'] ?? FALSE;

if($id){
    (new Carrito())->agregar_producto($id, $c);
    header('location: ../../index.php?link=carrito');
}