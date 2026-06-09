<?php 

require_once '../config/conexao.php';
require_once '../Models/Gasto.php';
require_once '../Repositories/GastoRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $descricao = trim($_POST['descricao']);
    $categoria = trim($_POST['categoria']);
    $valor = (float) $_POST['valor'];
    $data = $_POST['data'];

    $gasto = new Gasto($descricao, $categoria, $valor, $data);

    $repostitory = new GastoRepository($conn);

    if($repostitory->salvar($gasto)){
        header("Location: ../views/index.php");
        exit;
    }

    echo "Erro ao salvar gasto";

}

?>