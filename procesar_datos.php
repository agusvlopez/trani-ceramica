<?php
        
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
    
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $coment = $_GET['comentarios'];

    echo "<pre>";
    echo "<p>El dato del campo nombre es: ".ucfirst($nombre)." </p>";
    echo "<p>El dato del campo del apellido es: ".ucfirst($apellido)." </p>";

    if(strlen($coment)<=2){
    echo "<p>El usuario no ha hecho un comentario coherente ya que contiene 2 o menos caracteres</p>";
    }else {
        echo "<p>El comentario del usuario es: $coment </p>";
    }
    echo "</pre>";

   
?>

  <!DOCTYPE html>
  <html lang="es">
  
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Trani Cerámica</title>
  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  
      <link href="css/style.css" rel="stylesheet">
  
  </head>
  <body class="p-3">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
  
  </html>

 