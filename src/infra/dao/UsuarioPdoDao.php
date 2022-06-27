<?

namespace Jp\SindicatoTrainees\infra\dao;

require_once 'vendor/autoload.php';

use PDO;
use Jp\SindicatoTrainees\domain\models\Usuario;
use Jp\SindicatoTrainees\domain\dao\UsuarioDao;

class UsuarioPdoDao implements UsuarioDao
{

    private PDO $con;

    public function __construct(PDO $connection)
    {
        //dependency injection
        $this->con = $connection;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM uso_usuarios';
        $stmt = $this->con->query($sql);
        return $this->loadUsuarios($stmt);
    }
    public function findById(int $id): Usuario
    {
        $query = 'SELECT * FROM uso_usuarios WHERE uso_id = ?';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return new Usuario(null,'nomeUsuario', 'loginUsuario', 'senha');
    }
    public function search(...$params): Usuario
    {
        return new Usuario(null,'nomeUsuario', 'loginUsuario', 'senha');
    }
    public function insert(Usuario $usuario): bool
    {

        $this->con->beginTransaction();
        return true;
        $this->con->commit();
    }
    public function update(Usuario $usuario): bool
    {
        return true;
    }
    public function delete(Usuario $usuario): bool
    {
        return true;
    }
    private function loadUsuarios(\PDOStatement $stmt): array
    {
        $usuarios = $stmt->fetchAll();
        $arrayDeUsuarios = [];
        foreach ($usuarios as $usuario) {
                $usuario = new Usuario(
                        $usuario['uso_id'],
                        $usuario['uso_nome'],
                        $usuario['uso_login'],
                        $usuario['uso_senha']
                );
                $arrayDeUsuarios[] = $usuario;
        }
        return $arrayDeUsuarios;
    }
}