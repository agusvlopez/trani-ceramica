<?PHP 

class Imagen 
{
    private $error;


    public function subirImagen($directorio, $datosArchivo): string{

        if (!empty($datosArchivo['tmp_name'])){

            $original_name = (explode(".", $datosArchivo['name']));
            $extension = end($original_name);
            $fileName = time() . ".$extension";

            $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$fileName");

            if(!$fileUpload){
                throw new Exception ("No se pudo subir la imagen");
            }else{
                return $fileName;
            }
        }
    }



    public function eliminarImagen($archivo): bool
    {
        if (file_exists(($archivo))) {

            $fileDelete =  unlink($archivo);

            if (!$fileDelete) {
                throw new Exception("No se pudo eliminar la imagen");
            } else {
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Get the value of error
     */
    public function getError()
    {
        return $this->error;
    }
}