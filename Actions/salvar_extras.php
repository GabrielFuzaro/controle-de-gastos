<?php 

require_once '../config/conexao.php';
require_once '../Models/Extra.php';
require_once '../Repositories/ExtraRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $descricao = trim($_POST['descricao']);
    $valor = (float) $_POST['valor'];
    $data = $_POST['data_entrada'];
  
    $extra = new Extra($descricao, $valor, $data);

    $repository_extra = new ExtraRepository($conn);

    if($repository_extra->salvarExtra($extra)){
        header("Location: ../views/dashboard.php");
        exit;
    }
}

?>