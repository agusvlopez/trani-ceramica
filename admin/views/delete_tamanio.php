<?PHP
$id = $_GET['id'] ?? FALSE;
$tamanio = (new Tamanio())->get_por_id($id);
?>

<div class="container">
<div class="row my-5 g-3 ">
	<h1 class="text-center mb-5 fw-bold mt-5">¿Está seguro/a que desea eliminar este color?</h1>

	
        <div class="col-6">
		    <h2 class="fs-6">Nombre</h2>
		    <p><?= $tamanio->getNombre() ?></p>
        </div>

        <div class="col-6">
		    <h2 class="fs-6">Nombre</h2>
		    <p><?= $tamanio->getDescripcionMedida() ?></p>
        </div>
    
    <div class="col-12">
		<a href="actions/delete_tamanio_acc.php?id=<?= $tamanio->getId() ?>" role="button" class="d-block btn btn-sm btn-danger mt-4">Eliminar</a>
	</div>

</div>
</div>