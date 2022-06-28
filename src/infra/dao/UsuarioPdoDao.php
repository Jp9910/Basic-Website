<?php

namespace Jp\SindicatoTrainees\infra\dao;

use PDO;
use Jp\SindicatoTrainees\domain\models\Usuario;
use Jp\SindicatoTrainees\domain\interfaces\UsuarioDao;

class UsuarioPdoDao implements UsuarioDao
{

    private PDO $rConexao;

    public function __construct(PDO $connection)
    {
        //dependency injection
        $this->rConexao = $connection;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM uso_usuarios';
        $stmt = $this->rConexao->query($sql);
        return $this->loadUsuarios($stmt);
    }
    public function findById(int $id): Usuario
    {
        $query = 'SELECT * FROM uso_usuarios WHERE uso_id = ?';
        $stmt = $this->rConexao->prepare($query);
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

        $this->rConexao->beginTransaction();
        return true;
        $this->rConexao->commit();
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
        $aUsuarios = $stmt->fetchAll();
        $loArrayDeUsuarios = [];
        foreach ($aUsuarios as $usuario) {
                $usuario = new Usuario(
                        $usuario['uso_id'],
                        $usuario['uso_nome'],
                        $usuario['uso_login'],
                        $usuario['uso_senha']
                );
                $loArrayDeUsuarios[] = $usuario;
        }
        return $loArrayDeUsuarios;
    }
}