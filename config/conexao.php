<?php 

function getConnection(): PDO
{
    static $pdo = null;
    
    if($pdo === null){
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=controle_gastos;charset=utf8mb4", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            die("Erro na conexão: " . $e->getMessage());
        }
    }
    return $pdo;
}

?>