<?PHP

// echo "<pre>";
// print_r($_SESSION['loggedIn']);
// echo "</pre>"; 

$usuario = $_SESSION['loggedIn'];
$username = $_SESSION['loggedIn']['username'];
$rol = $_SESSION['loggedIn']['roles'];
$productos = (new Carrito())->get_carrito();

?>


<div class="p-4 mt-5 m-0 mx-auto">
    <div class="container">
    <h1 class="text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5"><?= $titulo ?></h1>
    <div class="pt-3 p-2 row">
<section class="vh-75 bg-negro">
  <div class="container py-5 h-100">
    <div class="row d-md-flex justify-content-center align-items-center h-100">
      <div class="col col-md-9 col-lg-7 col-xl-5">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-md-flex text-black">
              <div>
                <img src="img/iconos/woman-user.png"
                  alt="Imagen genérica de un usuario" class="img-fluid"
                  style="max-width: 180px; border-radius: 10px;">
              </div>
              <div class="flex-grow-1 ms-3">
                <p class="mb-1 fs-5"><?= $username;?></p>
                <p class="mb-2 pb-1" style="color: #2b2a2a;"><?= $rol;?></p>
                <div class="d-md-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
                  <?PHP if (count($productos)) { ?>
                  <div class="me-lg-4">
                    <p class="small text-muted mb-1">Tarjeta terminada en</p>
                    <p class="mb-0">976</p>
                  </div>

                  <div>
                    <p class="small text-muted mb-1">Total a pagar</p>
                    <p class="mb-0 h5">$<?= number_format((new Carrito())->precio_total(), 2, ",", ".") ?></p>
                  </div>
                </div>
                <div class="d-flex pt-1">
                  <a href="admin/actions/finalizar_compra_acc.php" role="button" class="btn bgDorado me-1 flex-grow-1 text-light">Pagar</a>
                </div>

                <?PHP } else { ?>
                                     
                <div class="pt-1 ">
                <p class="text-center">Hola! Aún no hay nada cargado en el carrito de compras</p>
                    <div class="d-flex">
                        <a href="index.php?link=piezas" role="button" class="btn bgDorado me-1 flex-grow-1 text-light m-1 mx-auto">Ver tienda</a>
                    </div>
                </div>
                <?PHP } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
       
    </div>
    </div>
</div>

