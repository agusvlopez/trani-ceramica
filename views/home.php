<?PHP
$objetoPieza = new Pieza();
$objetoCarrusel = new Carrusel();
$carrusel = $objetoCarrusel->carrusel_completo();
$catalogo = $objetoPieza->catalogo_completo();

?>

<div class="container">
<div class="d-flex justify-content-center w-100 mx-auto mt-5 pt-4">
    <div>
      <h1 class="text-center mt-2 fw-bold d-none h1Espaciado"><?= $titulo ?></h1>  

      <div class="row mb-4 d-flex align-items-center">
      <div>        
      <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <?PHP foreach ($carrusel as $archivo) { ?>  
    <div class="carousel-inner p-0 pb-3 card-title">
      <div class="carousel-item active">
        <img src="img/carrusel/<?= $archivo->getImg1(); ?>" class="img-fluid d-block w-100" alt="<?= $archivo->getAlt1(); ?>">
      </div>
      <div class="carousel-item">
        <img src="img/carrusel/<?= $archivo->getImg2(); ?>" class="img-fluid d-block w-100" alt="<?= $archivo->getAlt2(); ?>">
      </div>
      <div class="carousel-item">
        <img src="img/carrusel/<?= $archivo->getImg3(); ?>" class="img-fluid d-block w-100" alt="<?= $archivo->getAlt3(); ?>">
      </div>
      
    </div>
  <?PHP } ?>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
    </div>
  <section class="text-center pb-3">
    <p><strong>Trani</strong> <strong>Cerámica</strong> es un emprendimiento que empezó en 2019 y sigue en pie gracias a nuestros clientes fieles.</p>
    <p>Todas nuestras piezas estan hechas desde cero y con mucha dedicación</p>
    <p>¡Tambien realizamos <strong>piezas</strong> <strong>personalizadas</strong> para que tengas algo completamente hecho para vos!</p>
  </section>


  </div>
  </section>
</div>
</div>
</div>