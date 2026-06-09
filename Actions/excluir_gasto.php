<?php 

require_once '../config/conexao.php';
require_once '../Models/Gasto.php';
require_once '../Repositories/GastoRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['id'];

    $repository = new GastoRepository($conn);

    $excluir = $repository->excluir($id);

    header("Location: ../views/index.php");
    exit;
}

?>