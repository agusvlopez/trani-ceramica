<?PHP
$id = $_GET['id'] ?? FALSE;
$pieza = (new Pieza())->pieza_por_id($id);

$artista = (new Artista())->listado_completo();
$coleccion = (new Coleccion())->listado_completo();
$colores = (new Color())->listado_completo();
$tamanio = (new Tamanio())->listado_completo();
$tipos = (new Tipo())->listado_completo();

?>

<div class="my-5 container">
	<div>

		<h1 class="text-center mt-5 pt-5 mb-3 fs-2">Edición de datos de: <span class="fw-bold text-uppercase fs-3"><?= $pieza->getNombre() ?><span></h1>
		<div class="row mb-5 d-flex align-items-center">

			<form class="row g-3" action="actions/edit_pieza_acc.php?id=<?= $pieza->getId() ?>" method="POST" enctype="multipart/form-data">

				<div class="col-md-6 mb-3">
					<label for="titulo" class="form-label">Titulo</label>
					<input type="text" class="form-control" id="titulo" name="titulo" required value="<?= $pieza->getNombre() ?>">
				</div>

				<div class="col-md-6 mb-3">
					<label for="tipo_id" class="form-label">Tipo</label>
					<select class="form-select" name="tipo_id" id="tipo_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($tipos as $t) { ?>
							<option value="<?= $t->getId() ?>" <?= $t->getId() == $pieza->getTipo()->getId() ? "selected" : "" ?>>
								<?= $t->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col-md-4 mb-3">
					<label for="artista_id" class="form-label">Artista</label>
					<select class="form-select" name="artista_id" id="artista_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($artista as $a) { ?>
							<option value="<?= $a->getId() ?>" <?= $a->getId() == $a->getId() ? "selected" : "" ?>><?= $a->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col-md-4 mb-3">
					<label for="imagen_original" class="form-label">Imagen Actual</label>
					<img src="../img/covers/<?= $pieza->getImagen() ?>" alt="Imagen de <?= $pieza->getNombre() ?>" class="img-fluid shadow-sm d-block">
					<input class="form-control" type="hidden" id="imagen_original" name="imagen_original" required value="<?= $pieza->getImagen() ?>">
				</div>


				<div class="col-md-4 mb-3">
					<label for="imagen" class="form-label">Reemplazar Imagen</label>
					<input class="form-control" type="file" id="imagen" name="imagen">
				</div>

				<div class="col-md-4 mb-3">
					<label for="descripcion" class="form-label">Descripción</label>
					<input type="text" class="form-control" id="descripcion" name="descripcion" required value="<?= $pieza->getDescripcion() ?> ">
				</div>


				<div class="col-md-4 mb-3">
					<label for="tamanio_id" class="form-label">Tamaño</label>
					<select class="form-select" name="tamanio_id" id="tamanio_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($tamanio as $t) { ?>
							<option value="<?= $t->getId() ?>" <?= $t->getId() == $pieza->getTamaño()->getId() ? "selected" : "" ?>><?= $t->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col-md-4 mb-3">
					<label for="color_id" class="form-label">Color Principal</label>
					<select class="form-select" name="color_id" id="color_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($colores as $c) { ?>
							<option value="<?= $c->getId() ?>" <?= $c->getId() == $pieza->getColor()->getId() ? "selected" : "" ?>><?= $c->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col-md-12 mb-3">
					<label class="form-label d-block">Colores Secundarios</label>
					<?PHP
					foreach ($colores as $C) {
						$cs_seleccionados = $pieza->get_ids_colores_secundarios();			
					?>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="colores_de_piezas[]" id="colores_de_piezas_<?= $C->getId() ?>" value="<?= $C->getId() ?>" 
							<?= in_array($C->getId(), $cs_seleccionados) ? "checked" : "" ?>>
							<label class="form-check-label mb-2" for="colores_de_piezas_<?= $C->getId() ?>"><?= $C->getNombre() ?></label>
						</div>
					<?PHP } ?>
				</div>

                <div class="col-md-4 mb-3">
					<label for="precio" class="form-label">Precio</label>
					<input type="text" class="form-control" id="precio" name="precio" required value="<?= $pieza->getPrecio() ?> ">
				</div>

				<div class="col-md-6 mb-3">
					<label for="coleccion_id" class="form-label">Colección</label>
					<select class="form-select" name="coleccion_id" id="coleccion_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($coleccion as $colec) { ?>
							<option value="<?= $colec->getId() ?>" <?= $colec->getId() == $pieza->getColeccionId()->getId() ? "selected" : "" ?>><?= $colec->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col-md-4 mb-3">
					<label for="publicacion" class="form-label">Publicacion</label>
					<input type="date" class="form-control" id="publicacion" name="publicacion" required value="<?= $pieza->getPublicacion() ?>">
				</div>

				<button type="submit" class="btn btn-dark d-block m-2 mt-3">Editar</button>
			</form>
		</div>
	</div>
</div>