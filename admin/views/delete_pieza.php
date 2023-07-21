<?PHP
$id = $_GET['id'] ?? FALSE;
$pieza = (new Pieza())->pieza_por_id($id);
?>

<div class="container">
<div class="row my-5 g-3">
	<h1 class="text-center mt-5 mb-5 fw-bold ">¿Está seguro/a que desea eliminar este pieza?</h1>
	<div class="col-12 col-md-6">
		<img src="../img/covers/<?= $pieza->getImagen() ?>" alt="Imagen de <?= $pieza->getNombre() ?>" class="img-fluid rounded shadow-sm d-block mx-auto mb-3">
	</div>

	<div class="col-12 col-md-6">

		<h2 class="fs-6">Nombre</h2>
		<p><?= $pieza->getNombre() ?></p>

		<h2 class="fs-6">Descripción</h2>
		<p><?= $pieza->getDescripcion() ?></p>
		
		<h2 class="fs-6">Tipo</h2>
		<p><?= $pieza->getTipo()->getNombre() ?></p>

		<h2 class="fs-6">Precio</h2>
		<p>$<?= $pieza->getPrecio() ?></p>
		
		<h2 class="fs-6">Colección</h2>
		<p><?= $pieza->getColeccionId()->getNombre() ?></p>
		

		<a href="actions/delete_pieza_acc.php?id=<?= $pieza->getId() ?>" role="button" class="d-block btn btn-sm btn-danger mt-4">Eliminar</a>
	</div>


</div>
</div>