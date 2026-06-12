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

    if (strlen($descricao) < 3) {
    die("A descrição deve ter pelo menos 3 caracteres.");
    }
    if ($valor <= 0) {
        die("O valor deve ser maior que zero.");
    }

    $categoriasPermitidas = [
    'Alimentação',
    'Transporte',
    'Investimentos',
    'Minhas Coisas',
    'Presentes'
    ];

    if (!in_array($categoria, $categoriasPermitidas)) {
        die("Categoria inválida.");
    }

    $dataValida = DateTime::createFromFormat('Y-m-d', $data);

    if (!$dataValida) {
        die("Data inválida.");
    }

    $gasto = new Gasto($descricao, $categoria, $valor, $data);

    $repostitory = new GastoRepository($conn);

    if($repostitory->editarGasto($gasto, $id)){
        header("Location: ../views/dashboard.php");
        exit;
    }
}
?>