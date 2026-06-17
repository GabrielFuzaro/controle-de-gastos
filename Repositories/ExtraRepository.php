<?php 

require_once __DIR__ . '/../Models/Extra.php';

class ExtraRepository{
    private PDO $conn;

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    public function salvarExtra(Extra $extra): bool
{
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
}

    public function listarExtra(){
        $stmt = $this->conn->prepare("SELECT * FROM entradas");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function listarExtraPorMes($mes){
        $stmt = $this->conn->prepare("SELECT * FROM entradas
        WHERE MONTH(data_entrada) = :mes
        ORDER BY data_entrada DESC, id DESC");

        $stmt->execute(["mes" => $mes]);

        return $stmt->fetchAll();
    }

    public function somar(){
        $stmt = $this->conn->prepare("SELECT COALESCE(sum(valor), 0) AS total from entradas;");

        $stmt->execute();

        $resultado = $stmt->fetch();

        return (float) $resultado['total'];
    }

    public function somarPorMes($mes){
        $stmt = $this->conn->prepare("SELECT COALESCE(sum(valor), 0) as total from entradas
        WHERE MONTH(data_entrada) = :mes");

        $stmt->execute(["mes" => $mes]);

        $linha = $stmt->fetch();

        return (float) $linha['total'];
    }

    public function excluir($id){
        $stmt = $this->conn->prepare("DELETE FROM entradas
        WHERE id = ?");

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }

    public function editarExtra(Extra $extra, $id){
        $stmt = $this->conn->prepare("UPDATE entradas
        SET descricao = :descricao, valor = :valor, data_entrada = :data_entrada
        WHERE id = :id");

        $stmt->execute(["descricao" => $extra->descricao, "valor" => $extra->valor, "data_entrada" => $extra->data_entrada, "id" => $id]);

        return $stmt->rowCount() > 0;
    }

    public function buscarPorId($id){
        
    $stmt = $this->conn->prepare("SELECT * FROM entradas
            WHERE id = ?");

    $stmt->execute([$id]);

    return $stmt->fetch();
}

}
?>