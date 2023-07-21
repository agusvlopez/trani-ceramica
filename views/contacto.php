<div class="pt-4 mt-5 pb-4">
<h1 class="text-center mb-3 fs-3 text-uppercase fw-bold pb-4 pt-5 card-title btn-espaciado"><?= $titulo ?></h1>

<div class="container">
    <div class="row justify-content-center">
      
      <div class=" col-12 col-lg-8">
        
        <p class="p-3 mb-0 font-color-grey">Si tenes alguna duda o consulta, completá los siguientes campos... ¡Te vamos a responder lo antes posible!</p>
      </div> 
    </div>     

    <div class="row justify-content-center">
      <div class="col-12 col-lg-8 p-3">
            <!-- FORMULARIO -->

        <form action="./procesar_datos.php" method="GET" class="row"> 

            <div class="col-12 col-md-6 mb-3">
              <div class="form-floating">
                <input class="form-control rounded-0" type="text" name="nombre" id="nombre" aria-describedby="d_nombre" required>
                <label class="form-label" for="nombre">Ingresá tu nombre</label>
                
              </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
              <div class="form-floating">
                <input class="form-control rounded-0" type="text" name="apellido" id="apellido" aria-describedby="d_apellido">
                <label for="apellido" class="form-label">Ingresá tu apellido</label>
              </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
              <div class="form-floating">
                <input class="form-control rounded-0" type="email" name="email" aria-labelledby="d_email" required>
                <label for="email" class="form-label">Ingresá tu e-mail</label>
                <p class="form-text" id="d_email">No olvides el @</p>
              </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
              <div class="form-floating">
                <input class="form-control rounded-0" type="number" name="telefono" aria-labelledby="d_telefono">
                <label for="telefono" class="form-label">Ingresá tu teléfono (Opcional)</label>
                <p class="form-text" id="d_telefono">Sin código de área ni 15</p>
              </div>
            </div>
            
            <div class="col-12 mb-3">
              <label for="comentarios" class="form-label">Mensaje</label>
              <textarea class="form-control rounded-0" id="comentarios" name="comentarios" rows="3" required></textarea>
            </div>
        <?php
   
        ?>
            <div class="d-flex justify-content-end">
              <input type="submit" value="Enviar" class="btn btn-form-bg mt-3 btn-enviar rounded-0">
            </div>

        </form>

      </div>
    </div>
  

</div>
</div>
