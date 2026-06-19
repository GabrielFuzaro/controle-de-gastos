<?php

require_once '../config/conexao.php';
require_once '../Repositories/GastoRepository.php';

header('Content-Type: application/json; charset=utf-8');

$conn = getConnection();
$repository = new GastoRepository($conn);

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'GET') {
    $gastos = $repository->listar();

    echo json_encode($gastos, JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(405);

echo json_encode([
    "erro" => "Método não permitido"
]);