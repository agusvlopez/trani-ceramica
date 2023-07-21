<?PHP

$objetoPersonalizado = new Personalizado();
$carruselPersonalizados = $objetoPersonalizado->carrusel_completo();


?>

<!-- CARRUSEL -->
<div class="container pt-4 mt-5 portada">
<div class="d-flex justify-content-center w-100 mx-auto">
    <div>
      <h1 class="text-center mt-2 fw-bold h1Espaciado d-none"><?= $titulo ?></h1>  

      <div class="row mb-4 d-flex align-items-center">
      <div>        
      <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <?PHP foreach ($carruselPersonalizados as $p) { ?>  
    <div class="carousel-inner p-0 pb-3">
      <div class="carousel-item active">
        <img src="img/<?= $p->getImg1Personalizado(); ?>" class="img-fluid d-block w-100" alt="<?= $p->getAlt1Personalizado(); ?>">
      </div>
      <div class="carousel-item">
        <img src="img/<?= $p->getImg2Personalizado(); ?>" class="img-fluid d-block w-100" alt="<?= $p->getAlt2Personalizado(); ?>">
      </div>   
      <div class="carousel-item ">
        <img src="img/<?= $p->getImg3Personalizado(); ?>" class="img-fluid d-block w-100" alt="<?= $p->getAlt3Personalizado(); ?>">
      </div>      
    </div>
  <?PHP } ?>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>
    </div>
    </div>
  <section class="text-center pb-5 ">
    <h2 class="text-uppercase fs-4 fw-bolder btn-espaciado bg-negro p-4 text-light">¿Que ofrecemos?</h2>
    <div class="row p-4">
        <div class="col-md-6 p-4">
            <img src="img/iconos/colores.png" alt="Dibujo de paleta de colores" class="img-fluid logo m-3">
            <h3 class="fs-4 fw-lighter text-dark card-title">Colores personalizados</h3>
            <p class="fw-lighter text-dark pt-3">Adaptamos cualquiera de los productos de nuestras colecciones al <strong>color</strong> de tu marca. ¡Consultanos!</p>
        </div>
        <div class="col-md-6 p-4">
            <img src="img/iconos/marca.png" alt="Dibujo de jarrón de ceramica" class="img-fluid logo m-3">
            <h3 class="fs-4 fw-lighter text-dark card-title">Aplicación de marca</h3>
            <p class="fw-lighter text-dark pt-3">Podemos <strong>personalizar</strong> los articulos con el logotipo de tu marca, tu nombre, iniciales o incluso algun dibujo.</p>
        </div>
    </div>

    <a href="?link=contacto" class="btn btn-form-bg mt-3 btn-enviar rounded-0 text-uppercase p-3 fw-bolder">Envianos tu consulta</a>
  </section>


  </div>
  </section>
</div>
</div>
</div>