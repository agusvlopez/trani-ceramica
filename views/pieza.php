<?PHP

$idPieza = $_GET['id'] ?? FALSE;

$objetoPieza = new Pieza();

$pieza = $objetoPieza->pieza_por_id($idPieza);



?>

<div class="pt-5 mt-5">
    <h1 class="text-center p-4 mb-2 fs-3 fw-bold text-uppercase h1Espaciado bg-negro text-light"><?= $titulo ?></h1>

    <div class="container p-4">
       <div class="row-md">  
            
       <?PHP
        if(!empty($idPieza)){
       ?>
        
        <div class="d-md-flex col-md-12">
        <div class=" m-3 pt-2 rounded-0 col-md-4">
            <img src="img/covers/<?= $pieza->getImagen(); ?>" class="card-img-top img-fluid shadow rounded-0 h1Espaciado" alt="Imagen de <?= $pieza->getNombre();?>">
        </div>
        <div class="col-md-6 m-3">
            <h2 class="text-center fw-normal fs-4 card-title"><?= strtoupper($pieza->getNombre()); ?></h2>
        <div class="descripcionCatalogoPiezas shadow-sm p-4">     
            <p class="card-text mb-4 fw-lighter"><?= $pieza->getDescripcion(); ?></p>
            <p class="card-text mb-1"><span class="fw-lighter fst-italic">Tipo de producto</span> <?= ucfirst($pieza->getTipo()->getNombre()) ?></p>
            <p class="card-text mb-1 "><span class="fw-lighter fst-italic">Tamaño</span> <?= $pieza->getTamaño()->getNombre();?></p>

            <p class="card-text mb-4 "><span class="fw-lighter fst-italic">Artista</span> <?= $pieza->getArtistaId()->getNombre(); ?></p>
            <p class="card-text mb-4 "><span class="fw-lighter fst-italic">Colección </span> '<?= $pieza->getColeccionId()->getNombre(); ?>'</p>
            <p class="precioCatalogo fs-4 rounded-0 mb-2">$<?= $pieza->number_format()?></p>
            <form action="admin/actions/add_producto_acc.php" method="GET" class="row">
                <div class="col-6 d-flex align-items-center">
                    <label for="c" class="fw-bold me-2">Cantidad: </label>
                    <input type="number" class="form-control" value="1" name="c" id="c">
                </div>

                <div class="col-6">
                    <input type="submit" value="<?= strtoupper("Agregar al carrito") ?>" class="btn bg-dark p-2 shadow d-block mx-auto m-2 text-light text-uppercase rounded-0">
                    <input type="hidden" value="<?= $idPieza ?>" name="id" id="id">
                </div>

            </form>

        
        </div>

        </div>
        </div>
        

    

    <?PHP } ?>

    <?PHP if(empty($idPieza)){ ?>
        <div class="text-center p-3">
            <p>La página que busca no existe</p>
            <a href="?link=home">Ir al Home</a>
        </div>
        <?PHP } ?>
    
    </div>
    </div>           
    
   
</div>
</div>

