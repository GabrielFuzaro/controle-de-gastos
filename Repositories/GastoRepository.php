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
}
?>