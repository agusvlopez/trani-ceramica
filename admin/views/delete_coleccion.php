<?PHP
$id = $_GET['id'] ?? FALSE;
$coleccion = (new Coleccion())->get_por_id($id);
?>

<div class="container">
<div class="row my-5 g-3 ">
	<h1 class="text-center mb-5 fw-bold mt-5">¿Está seguro/a que desea eliminar esta colección?</h1>

	
        <div class="col-6">
		    <h2 class="fs-6">Nombre</h2>
		    <p><?= $coleccion->getNombre() ?></p>
        </div>

        <div class="col-6">
		    <h2 class="fs-6">Descripción</h2>
		    <p><?= $coleccion->getDescripcionColeccion() ?></p>
		</div>
    
    <div class="col-12">
		<a href="actions/delete_coleccion_acc.php?id=<?= $coleccion->getId() ?>" role="button" class="d-block btn btn-sm btn-danger mt-4">Eliminar</a>
	</div>


</div>
</div>