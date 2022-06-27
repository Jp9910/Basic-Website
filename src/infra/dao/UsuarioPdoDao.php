<?

namespace Jp\SindicatoTrainees\infra\dao;

require_once 'vendor/autoload.php';

use PDO;
use Jp\SindicatoTrainees\domain\Models\Usuario;
use Jp\SindicatoTrainees\domain\dao\UsuarioDao;

class UsuarioPdoDao implements UsuarioDao
{

    private PDO $con;

    public function __construct($connection)
    {
        //dependency injection
        $this->con = $connection;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM uso_usuarios';
        $stmt = $this->con->query($sql);
        return $this->hydrateUsuarios($stmt);
    }
    public function findById(): Usuario
    {
        return new Usuario(null,'nomeUsuario', 'loginUsuario');
    }
    public function search(...$params): Usuario
    {
        return new Usuario(null,'nomeUsuario', 'loginUsuario');
    }
    public function insert(): bool
    {
        return true;
    }
    public function update(): bool
    {
        return true;
    }
    public function delete(): bool
    {
        return true;
    }
    private function hydrateUsuarios(\PDOStatement $stmt): array
    {
        $todosUsuarios = $stmt->fetchAll();
        $arrayDeUsuarios = [];
        foreach ($todosUsuarios as $usuario) {
                $usuario = new Usuario(
                        $usuario['uso_id'],
                        $usuario['uso_nome'],
                        $usuario['uso_login']
                );
                $arrayDeUsuarios[] = $usuario;
        }
        return $arrayDeUsuarios;
    }
}