<?= 
$username = $_SESSION['loggedIn']['username'];
?>

<div class="p-4 mt-5 m-0 mx-auto">
    <div class="container">
    <h1 class="text-center fs-3 fw-bold pt-5"><?= $titulo ?></h1>
    <div class="pt-3 p-2 row">

      <section>
        <div class="p-3 text-center">
          <img src="img/iconos/ceramics.png" alt="Dibujo de piezas de cerámica" class="img-fluid" style="max-width: 180px;">
        </div>
        <div class="text-center">
          <p>Su consulta ha sido enviada correctamente.
          Te enviaremos un mail con la respuesta lo antes posible.</p>
          <p>¡Muchas gracias <span><?= $username ?></span>! </p>
          <p class="fw-bold">Trani Cerámica</p>
        </div>
      </section>
    </div>
    </div>
</div>