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
        $stmt = $this->conn->prepare("DELETE FROM gastos
        WHERE id = ?");

        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();
        
        return $resultado;
    }

    public function listarPorMes($mes){

        $stmt = $this->conn->prepare("SELECT * FROM gastos
        WHERE MONTH(data_gasto) = ?
        ORDER BY data_gasto DESC, id DESC");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function somarPorMes($mes){
        $stmt = $this->conn->prepare("SELECT sum(valor) as total from gastos
        WHERE MONTH(data_gasto) = ? ");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $linha = $resultado->fetch_assoc();

        return (float) $linha['total'];
    }

    public function somarPorCategoriaMes($mes){

        $stmt = $this->conn->prepare("SELECT categoria, SUM(valor) AS total 
                FROM gastos
                WHERE MONTH(data_gasto) = ?
                GROUP BY categoria");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function somarPorCategoria(){
        
    $sql = "SELECT categoria, SUM(valor) AS total 
                FROM gastos
                GROUP BY categoria";

    $resultado = mysqli_query($this->conn, $sql);

    return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function editarGasto(Gasto $gasto, $id){
        $stmt = $this->conn->prepare("UPDATE gastos
        SET descricao = ?, categoria = ?, valor = ?, data_gasto = ?
        WHERE id = ?");

        $stmt->bind_param("ssdsi", $gasto->descricao, $gasto->categoria, $gasto->valor, $gasto->data_gasto, $id);

        return $stmt->execute();
    }

    public function buscarPorId($id){

    $stmt = $this->conn->prepare("SELECT * FROM gastos
            WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $resultado = $stmt->get_result();

    return $resultado->fetch_assoc();
}

    public function contarGastos(){
    $sql = "SELECT COUNT(*) AS total FROM gastos";

    $resultado = mysqli_query($this->conn, $sql);

    $linha = mysqli_fetch_assoc($resultado);

    return $linha['total'];
}

    public function buscarMaiorGasto(){
        $sql = "SELECT MAX(valor) AS maior FROM gastos";

        $resultado = mysqli_query($this->conn, $sql);

        $linha = mysqli_fetch_assoc($resultado);

        return (float) $linha['maior'];
    }

    public function buscarCategoriaMaisGasta(){
        $sql = "SELECT categoria, SUM(valor) AS total
                FROM gastos     
                GROUP BY categoria
                ORDER BY total DESC
                LIMIT 1";

        $resultado = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($resultado);
    }

    public function contarGastosMes($mes){
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM gastos
                WHERE MONTH(data_gasto) = ?");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $linha = $resultado->fetch_assoc();

        return (int) $linha['total'];
    }
    

    public function buscarMaiorGastoMes($mes){
        $stmt = $this->conn->prepare("SELECT MAX(valor) AS maior FROM gastos
                WHERE MONTH(data_gasto) = ?");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $linha = $resultado->fetch_assoc();

        return (float) $linha['maior'];
    }

    public function buscarCategoriaMaisGastaMes($mes){

        $stmt = $this->conn->prepare("SELECT categoria, SUM(valor) AS total
                FROM gastos
                WHERE MONTH(data_gasto) = ?     
                GROUP BY categoria
                ORDER BY total DESC
                LIMIT 1");

        $stmt->bind_param("i", $mes);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }
}
?>