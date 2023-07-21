<?PHP

class Usuario
{

    private $id;
    private $email;
    private $nombre_usuario;
    private $nombre_completo;
    private $pass;
    private $roles;



    /**
     * Encuentra un usuario por su Username
     * @param string $username El nombre de usuario
     */
    public function usuario_x_username(string $username): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE nombre_usuario = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$username]);

        $result = $PDOStatement->fetch();

        if (!$result) {
            return null;
        }
        return $result;
    }

 /**
     * Encuentra un usuario por su Id
     * @param int $idUser El nombre de usuario
     */
    public function usuario_x_id(int $idUser): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$idUser]);

        $result = $PDOStatement->fetch();

        if (!$result) {
            return null;
        }
        return $result;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of nombre_usuario
     */
    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Get the value of nombre_completo
     */
    public function getNombreCompleto()
    {
        return $this->nombre_completo;
    }

    /**
     * Get the value of pass
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Get the value of roles
     */
    public function getRoles()
    {
        return $this->roles;
    }
};