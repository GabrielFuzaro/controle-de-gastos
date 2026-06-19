<?php 
session_start();

require_once '../config/conexao.php';
require_once '../Models/Gasto.php';
require_once '../Repositories/GastoRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            die('Ação não autorizada.');
        }

    $conn = getConnection();

    $id = (int) $_POST['id'];

    $repository = new GastoRepository($conn);

    $repository->excluir($id);

    header("Location: ../views/dashboard.php");
    exit;
}

