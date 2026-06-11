<?php 

require_once '../config/conexao.php';
require_once '../Models/Extra.php';
require_once '../Repositories/ExtraRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['id'];
    $descricao = trim($_POST['descricao']);
    $valor = (float) $_POST['valor'];
    $data = $_POST['data'];

    $extra = new Extra($descricao, $valor, $data);

    $repostitory = new ExtraRepository($conn);

    if($repostitory->editarExtra($extra, $id)){
        header("Location: ../views/dashboard.php");
        exit;
    }
}
?>