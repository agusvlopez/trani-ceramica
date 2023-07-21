<?php
$objetoPieza = new Pieza();

$piezaSeleccionada = $_GET['tipo'] ?? '';
$colorPieza = $_GET['color'] ?? '';
$precioPieza = $_GET['precio'] ?? '';

if($piezaSeleccionada){
    $tipo = (new Tipo())->get_por_id($piezaSeleccionada);
    $titulo = $tipo->getNombre();
}else {
    $tipo = (new Tipo())->tipo_completo();
    $titulo = "todos los productos";
}

if($piezaSeleccionada){
   $catalogo = $objetoPieza->catalogo_por_pieza($piezaSeleccionada);
   
    if($colorPieza){
        $catalogo = $objetoPieza->pieza_por_($piezaSeleccionada, $colorPieza);  
        if($precioPieza){
        $catalogo = $objetoPieza->pieza_por_tipo_color_precio($piezaSeleccionada, $colorPieza, $precioPieza);
        }
    }  

    else if($precioPieza){
        $catalogo = $objetoPieza->pieza_por_tipo_precio($piezaSeleccionada, $precioPieza);

    }
}

else{
    $catalogo = $objetoPieza->catalogo_completo();

    if($colorPieza){
        $catalogo =  $objetoPieza->pieza_por_color($colorPieza);
        if($precioPieza){
            $catalogo =  $objetoPieza->pieza_por_color_precio($colorPieza, $precioPieza);
        }
}
    else if($precioPieza){
    $catalogo =  $objetoPieza->pieza_por_precio($precioPieza);
}

}

?>

<div class="pt-4 mt-5">
    <h1 class="text-center mb-3 fs-3 text-uppercase fw-bold pb-4 pt-5 card-title h1Espaciado"><?= $titulo ?></h1>

    <div class="container">
       <div class="row g-0">    

       <?PHP
        if(!empty($catalogo)){ 
        ?>
        <!-- FILTRO POR COLOR -->
        <ul class="nav nav-pills col-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Filtrar por color</a>
        <ul class="dropdown-menu dropdown-menu-dark rounded-0">       
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=">Todos los colores</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=21">Blanco</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=22">Negro</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=23">Gris</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=24">Verde</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=25">Marrón</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=26">Rosa</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=27">Celeste</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=28">Azul</a></li>
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=29">Mixto</a></li>
        </ul>
        </li>
        </ul>
            <!-- FILTRO POR PRECIO -->
        <ul class="nav nav-pills col-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Filtrar por precio</a>
        <ul class="dropdown-menu dropdown-menu-dark rounded-0"> 
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=<?=$colorPieza ?>&precio=">Todos los precios</a></li>      
            <li><a class="dropdown-item" href="index.php?link=piezas&tipo=<?=$piezaSeleccionada ?>&color=<?=$colorPieza ?>&precio=2500">Hasta 2500</a></li>         
        </ul>
        </li>
        </ul>

        <div class="container">
        <div class="row g-0">  
        
        <?PHP foreach ($catalogo as $pieza) { ?> 

    <div class="card mb-3 pt-2 catalogoPiezas rounded-0">
        <img src="img/covers/<?= $pieza->getImagen(); ?>" class="card-img-top img-fluid shadow rounded-0" alt="Imagen de <?= $pieza->getNombre(); ?>">
    <h2 class="card-title text-center fw-normal fs-5"><?= $pieza->getNombre(); ?></h2>
    <div class="card-body descripcionCatalogoPiezas shadow-sm ">     
        <p class="card-text mb-4 fw-lighter"><?= $pieza->recortar_descripcion() ?></p>
        <p class="precioCatalogo rounded-0">$<?= $pieza->number_Format(); ?></p>
        <a href="index.php?link=pieza&id=<?= $pieza->getId(); ?>" class="btn p-2 shadow d-block w-50 mx-auto m-2 bg-dark text-light text-uppercase rounded-0">Ver más</a>
    </div>
    </div>

    <?PHP } ?>

    
        </div>
        <?PHP } ?>
           
        <?PHP if(empty($catalogo)){ ?>
        <div class="text-center p-3">
            <p>La página que busca no existe</p>
            <a href="?link=home">Ir al Home</a>
        </div>
        
        <?PHP } ?>
       
    </div>
    </div>           
    
   
</div>
</div>

