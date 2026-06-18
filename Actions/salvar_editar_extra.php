<?php 

require_once '../config/conexao.php';
require_once '../Models/Extra.php';
require_once '../Repositories/ExtraRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = getConnection();

    $id = (int) ($_POST['id']?? 0);
    $descricao = trim($_POST['descricao']?? '');
    $valor = (float) $_POST['valor'];
    $data = $_POST['data']?? '';

    if ($id <= 0) {
        die("ID inválido.");
    }

    if (strlen($descricao) < 3) {
    die("A descrição deve ter pelo menos 3 caracteres.");
    }
    if ($valor <= 0) {
        die("O valor deve ser maior que zero.");
    }

    $dataValida = DateTime::createFromFormat('Y-m-d', $data);

    if (!$dataValida) {
        die("Data inválida.");
    }

    $extra = new Extra($descricao, $valor, $data);

    $repostitory = new ExtraRepository($conn);

    if($repostitory->editarExtra($extra, $id)){
        header("Location: ../views/dashboard.php");
        exit;
    }
}
?>