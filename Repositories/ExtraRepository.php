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
        $stmt = $this->conn->prepare("SELECT * FROM entradas
        WHERE MONTH(data_entrada) = ?
        ORDER BY data_entrada DESC, id DESC");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function somar(){
        $sql = "SELECT sum(valor) AS total from entradas;";

        $resultado = mysqli_query($this->conn, $sql);

        $linha = mysqli_fetch_assoc($resultado);

        return (float) $linha['total'];
    }

    public function somarPorMes($mes){
        $stmt = $this->conn->prepare("SELECT sum(valor) as total from entradas
        WHERE MONTH(data_entrada) = ?");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $linha = $resultado->fetch_assoc();

        return (float) $linha['total'];
    }

    public function excluir($id){
        $stmt = $this->conn->prepare("DELETE FROM entradas
        WHERE id = ?");

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function editarExtra(Extra $extra, $id){
        $stmt = $this->conn->prepare("UPDATE entradas
        SET descricao = ?, valor = ?, data_entrada = ?
        WHERE id = ?");

        $stmt->bind_param("sdsi", $extra->descricao, $extra->valor, $extra->data_entrada, $id);

        return $stmt->execute();
    }

    public function buscarPorId($id){
        
    $stmt = $this->conn->prepare("SELECT * FROM entradas
            WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $resultado = $stmt->get_result();

    return $resultado->fetch_assoc();
}
}
?>