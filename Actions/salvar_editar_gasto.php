<?php 

require_once '../config/conexao.php';
require_once '../Models/Gasto.php';
require_once '../Repositories/GastoRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['id'];
    $descricao = trim($_POST['descricao']);
    $categoria = trim($_POST['categoria']);
    $valor = (float) $_POST['valor'];
    $data = $_POST['data'];

    $gasto = new Gasto($descricao, $categoria, $valor, $data);

    $repostitory = new GastoRepository($conn);

    if($repostitory->editarGasto($gasto, $id)){
        header("Location: ../views/dashboard.php");
        exit;
    }
}
?>