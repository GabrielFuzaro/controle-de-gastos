<?php 

require_once '../config/conexao.php';
require_once '../Models/Extra.php';
require_once '../Repositories/ExtraRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = getConnection();

    $descricao = trim($_POST['descricao'] ?? '');
    $valor = (float) trim($_POST['valor'] ?? '');
    $data = trim($_POST['data_entrada']);

    if($descricao === '' || $valor === false || $valor<=0 || $data === ''){
        $_SESSION['erro'] = 'Preencha todos os campos corretamente!';
        header("Location: ../views/cadastrar_gasto.php");
    }else{

    $extra = new Extra($descricao, $valor, $data);

    $repository_extra = new ExtraRepository($conn);

        if($repository_extra->salvar($extra)){
            header("Location: ../views/dashboard.php");
            exit;
        }

    $_SESSION['erro'] = 'Erro ao cadastrar entrada.';
    header("Location: ../Views/cadastrar_gasto.php");
    exit;
    }
}

