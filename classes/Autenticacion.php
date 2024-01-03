<?PHP

class Autenticacion
{

    /**
     * Verifica las credenciales del usuario, y de ser correctas, guarda los datos en la sesión
     * @param string $username El nombre de usuario provisto
     * @param string $password El password provisto
     * @return bool Devuelve TRUE en caso que las credenciales sean correctas, FALSE en caso de que no lo sean
     */
    public function log_in(string $usuario, string $password): mixed
    {
        
        $datosUsuario = (new Usuario())->usuario_x_username($usuario);

    if($datosUsuario){
        if (password_verify($password, $datosUsuario->getPass())) {
            $datosLogin['username'] = $datosUsuario->getNombreUsuario();
            $datosLogin['id'] = $datosUsuario->getId();
            $datosLogin['roles'] = $datosUsuario->getRoles();
            $_SESSION['loggedIn'] = $datosLogin;
            return $datosLogin['roles'];
        } else {
            (new Alerta)->add_alerta('danger', 'La contraseña ingresada es incorrecta');
            return FALSE;
        }

    }else {
        (new Alerta())->add_alerta('warning', 'El usuario ingresado no existe');
        return NULL;
    }
    }

    /**
     * Cierra la sesión
     */
    public function log_out()
    {
    
        if (isset($_SESSION['loggedIn'])) {
            unset($_SESSION['loggedIn']);
        };
    }

    public function verify($admin = TRUE): bool
    {
        if (isset($_SESSION['loggedIn'])) {
            
        if($admin){
            if ($_SESSION['loggedIn']['roles'] == "admin" OR $_SESSION['loggedIn']['roles'] == "superadmin"){
                return TRUE;

            }else{
                (new Alerta())->add_alerta('warning', 'El usuario no puede entrar a esta área');
                header('location: index.php?link=login');
            }
        }
        

            //echo "<pre>";
            //var_dump($_SESSION['loggedIn']);
            //echo "</pre>";
            return TRUE;
        } else {
            header('location: index.php?link=login');
        }
    }
}