<?php 

require_once '../config/conexao.php';
require_once '../Models/Extra.php';
require_once '../Repositories/ExtraRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = getConnection();

    $id = $_POST['id'];

    $repository = new ExtraRepository($conn);

    $excluir = $repository->excluir($id);

    header("Location: ../views/dashboard.php");
    exit;
}

?>