<?php 

require_once __DIR__ . '/../Models/Extra.php';

class ExtraRepository{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function salvarExtra(Extra $extra){
        $stmt= $this->conn->prepare("INSERT INTO entradas (descricao, valor, data_entrada)
        VALUES(?, ?, ?)");

        $stmt->bind_param("sds",
        $extra->descricao,
        $extra->valor,
        $extra->data_entrada);

        return $stmt->execute();
    }

    public function listarExtra(){
        $sql = "SELECT * FROM entradas";

        $resultado = mysqli_query($this->conn, $sql);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function listarExtraPorMes($mes){
        $sql = "SELECT * FROM entradas
        WHERE MONTH(data_entrada) = $mes
        ORDER BY data_entrada DESC, id DESC";

        $resultado = mysqli_query($this->conn, $sql);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function somar(){
        $sql = "SELECT sum(valor) AS total from entradas;";

        $resultado = mysqli_query($this->conn, $sql);

        $linha = mysqli_fetch_assoc($resultado);

        return (float) $linha['total'];
    }

    public function somarPorMes($mes){
        $sql = "SELECT sum(valor) as total from entradas
        WHERE MONTH(data_entrada) = $mes";

        $resultado = mysqli_query($this->conn, $sql);

        $linha = mysqli_fetch_assoc($resultado);

        return (float) $linha['total'];
    }

    public function excluir($id){
        $sql = "DELETE FROM entradas
        WHERE id = $id";

        $resultado = mysqli_query($this->conn, $sql);

        return $resultado;
    }
}
?>