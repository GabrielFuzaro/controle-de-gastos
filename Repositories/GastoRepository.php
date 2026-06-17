<?php

require_once __DIR__ . '/../Models/Gasto.php';

class GastoRepository
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function salvar(Gasto $gasto)
    {
        $stmt = $this->conn->prepare("INSERT INTO gastos (descricao, categoria, valor, data_gasto)
            VALUES (:descricao, :categoria, :valor, :data_gasto)
        ");

        $stmt->execute(["descricao" => $gasto->descricao, "categoria" => $gasto->categoria, "valor" => $gasto->valor, "data_gasto" => $gasto->data_gasto]);

        return $stmt->rowCount() > 0;
    }

    public function listar(){

        $stmt = $this->conn->prepare("SELECT * FROM gastos
        ORDER BY data_gasto DESC, id DESC");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function somar(){
        $stmt = $this->conn->prepare("SELECT sum(valor) AS total from gastos;");

        $stmt->execute();

        $linha = $stmt->fetch();

        return (float) $linha['total'];
    }

    public function excluir($id){
        $stmt = $this->conn->prepare("DELETE FROM gastos
        WHERE id = ?");

       $stmt->execute([$id]);
        
        return $stmt->rowCount() > 0;
    }

    public function listarPorMes($mes){

        $stmt = $this->conn->prepare("SELECT * FROM gastos
        WHERE MONTH(data_gasto) = ?
        ORDER BY data_gasto DESC, id DESC");

        $stmt->execute([$mes]);

        return $stmt->fetchAll();
    }

    public function somarPorMes($mes){
        $stmt = $this->conn->prepare("SELECT sum(valor) as total from gastos
        WHERE MONTH(data_gasto) = ? ");

        $stmt->execute([$mes]);

        $linha = $stmt->fetch();

        return (float) $linha['total'];
    }

    public function somarPorCategoriaMes($mes){

        $stmt = $this->conn->prepare("SELECT categoria, SUM(valor) AS total 
                FROM gastos
                WHERE MONTH(data_gasto) = ?
                GROUP BY categoria");

        $stmt->execute([$mes]);

        return $stmt->fetchAll();
    }

    public function somarPorCategoria(){
        
        $stmt = $this->conn->prepare("SELECT categoria, SUM(valor) AS total 
                    FROM gastos
                    GROUP BY categoria");

        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function editarGasto(Gasto $gasto, $id){
        $stmt = $this->conn->prepare("UPDATE gastos
        SET descricao = ?, categoria = ?, valor = ?, data_gasto = ?
        WHERE id = ?");

        return $stmt->execute([$gasto->descricao, $gasto->categoria, $gasto->valor, $gasto->data_gasto, $id]);

    }

    public function buscarPorId($id){

    $stmt = $this->conn->prepare("SELECT * FROM gastos
            WHERE id = ?");

    $stmt->execute([$id]);

    return $stmt->fetch();
}

    public function contarGastos(){
    $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM gastos");

    $stmt->execute();

    return $stmt->fetch();
}

    public function buscarMaiorGasto(){
        $stmt = $this->conn->prepare("SELECT MAX(valor) AS maior FROM gastos");

        $stmt->execute();

        return $stmt->fetch();
    }

    public function buscarCategoriaMaisGasta(){
        $stmt = $this->conn->prepare("SELECT categoria, SUM(valor) AS total
                FROM gastos     
                GROUP BY categoria
                ORDER BY total DESC
                LIMIT 1");

        $stmt->execute();
        
        return $stmt->fetch();
    }

    public function contarGastosMes($mes){
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM gastos
                WHERE MONTH(data_gasto) = :data_gasto");
        
        $stmt->execute(["data_gasto" => $mes]);

        return $stmt->fetch();
    }
    

    public function buscarMaiorGastoMes($mes){
        $stmt = $this->conn->prepare("SELECT MAX(valor) AS maior FROM gastos
                WHERE MONTH(data_gasto) = ?");

        $stmt->execute([$mes]);

        return $stmt->fetch();
    }

    public function buscarCategoriaMaisGastaMes($mes){

        $stmt = $this->conn->prepare("SELECT categoria, SUM(valor) AS total
                FROM gastos
                WHERE MONTH(data_gasto) = ?     
                GROUP BY categoria
                ORDER BY total DESC
                LIMIT 1");

        $stmt->execute([$mes]);

        return $stmt->fetch();
    }
}
?>