<?PHP 
require_once "../../functions/autoload.php";

(new Carrito())->vaciar_carrito();
header('location: ../../index.php?link=carrito');