<?php

require_once __DIR__ . '/../Models/Gasto.php';

class GastoRepository
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function salvar(Gasto $gasto)
    {
        $stmt = $this->conn->prepare("INSERT INTO gastos (descricao, categoria, valor, data_gasto)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ssds",
            $gasto->descricao,
            $gasto->categoria,
            $gasto->valor,
            $gasto->data_gasto
        );

        return $stmt->execute();
    }

    public function listar(){

        $sql = "SELECT * FROM gastos
        ORDER BY data_gasto DESC, id DESC";

        $resultado = mysqli_query($this->conn, $sql);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function somar(){
        $sql = "SELECT sum(valor) AS total from gastos;";

        $resultado = mysqli_query($this->conn, $sql);

        $linha = mysqli_fetch_assoc($resultado);

        return (float) $linha['total'];
    }
    public function excluir($id){
        $sql = "DELETE FROM gastos
        WHERE id = $id";

        $resultado = mysqli_query($this->conn, $sql);

        return $resultado;
    }

    public function listarPorMes($mes){

        $sql = "SELECT * FROM gastos
        WHERE MONTH(data_gasto) = $mes
        ORDER BY data_gasto DESC, id DESC";

        $resultado = mysqli_query($this->conn, $sql);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function somarPorMes($mes){
        $sql = "SELECT sum(valor) as total from gastos
        WHERE MONTH(data_gasto) = $mes";

        $resultado = mysqli_query($this->conn, $sql);

        $linha = mysqli_fetch_assoc($resultado);

        return (float) $linha['total'];
    }

    public function somarPorCategoria(){
    $sql = "SELECT categoria, sum(valor) FROM gastos
    GROUP BY categoria";

    $resultado = mysqli_query($this->conn, $sql);

    return $resultado;
    }
}
?>