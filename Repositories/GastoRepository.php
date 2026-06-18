<?php

require_once __DIR__ . '/../Models/Gasto.php';
require_once __DIR__ . '/RepositoryInterface.php';
require_once __DIR__ . '/SomaTrait.php';

class GastoRepository implements RepositoryInterface
{
    use SomaTrait;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function salvar(object $gasto):bool {
            try{
            $stmt = $this->conn->prepare("INSERT INTO gastos (descricao, categoria, valor, data_gasto)
                VALUES (:descricao, :categoria, :valor, :data_gasto)
            ");

            $stmt->execute(["descricao" => $gasto->descricao, "categoria" => $gasto->categoria, "valor" => $gasto->valor, "data_gasto" => $gasto->data_gasto]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e){
            return false;
        }
    }

    public function listar():array {

        $stmt = $this->conn->prepare("SELECT * FROM gastos
        ORDER BY data_gasto DESC, id DESC");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function somar(){
        return $this->executarSoma("SELECT SUM(valor) AS total FROM gastos");
    }

    public function excluir(int $id):bool {
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

    public function somarPorMes(int $mes):float {
        return $this->executarSoma("SELECT SUM(valor) AS total FROM gastos WHERE MONTH(data_gasto) = ?",
        [$mes]);
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

    public function buscarPorId(int $id):array|false {

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