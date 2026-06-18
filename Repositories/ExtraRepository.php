<?php 

require_once __DIR__ . '/../Models/Extra.php';
require_once __DIR__ . '/RepositoryInterface.php';
require_once __DIR__ . '/SomaTrait.php';

class ExtraRepository implements RepositoryInterface{

    use SomaTrait;

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    public function salvar(object $extra): bool
{ 
    try{
        $stmt = $this->conn->prepare(
            "INSERT INTO entradas (descricao, valor, data_entrada)
            VALUES (:descricao, :valor, :data_entrada)"
        );

        $stmt->execute([
            "descricao" => $extra->descricao,
            "valor" => $extra->valor,
            "data_entrada" => $extra->data_entrada
        ]);

        return $stmt->rowCount() > 0;
    }catch (PDOException $e){
        return false;
    }
}

    public function listar():array {
        $stmt = $this->conn->prepare("SELECT * FROM entradas
        ORDER BY data_entrada DESC, id DESC");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function listarExtraPorMes(int $mes): array{
        $stmt = $this->conn->prepare("SELECT * FROM entradas
        WHERE MONTH(data_entrada) = :mes
        ORDER BY data_entrada DESC, id DESC");

        $stmt->execute(["mes" => $mes]);

        return $stmt->fetchAll();
    }

    public function somar(): float{
        return $this->executarSoma("SELECT SUM(valor) AS total FROM entradas");
    }

    public function somarPorMes(int $mes): float{
         return $this->executarSoma("SELECT SUM(valor) AS total FROM entradas WHERE MONTH(data_entrada) = ?",
        [$mes]);
    }

    public function excluir(int $id):bool {
        try{
            $stmt = $this->conn->prepare("DELETE FROM entradas
            WHERE id = ?");

            $stmt->execute([$id]);

            return $stmt->rowCount() > 0;
        }catch(PDOException $e){
            return false;
        }
    }

    public function editarExtra(Extra $extra, $id): bool{
        try{
            $stmt = $this->conn->prepare("UPDATE entradas
            SET descricao = :descricao, valor = :valor, data_entrada = :data_entrada
            WHERE id = :id");

            return $stmt->execute(["descricao" => $extra->descricao, "valor" => $extra->valor, "data_entrada" => $extra->data_entrada, "id" => $id]);

        }catch(PDOException $e){
            return false;
        }
    }

    public function buscarPorId(int $id):array|false {
        
    $stmt = $this->conn->prepare("SELECT * FROM entradas
            WHERE id = ?");

    $stmt->execute([$id]);

    return $stmt->fetch();
}

}
?>