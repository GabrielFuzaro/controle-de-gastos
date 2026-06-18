<?php 

require_once '../config/conexao.php';
require_once '../Models/Gasto.php';
require_once '../Repositories/GastoRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = getConnection();

    $descricao = trim($_POST['descricao'])?? '';
    $categoria = trim($_POST['categoria'])?? '';
    $valor = (float) $_POST['valor'];
    $data = $_POST['data']?? '';

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

    if (!in_array($categoria, $categoriasPermitidas, true)) {
        die("Categoria inválida.");
    }

    $dataValida = DateTime::createFromFormat('Y-m-d', $data);

    if (!$dataValida) {
        die("Data inválida.");
    }

    $gasto = new Gasto($descricao, $categoria, $valor, $data);

    $repository = new GastoRepository($conn);

    if($repository->salvar($gasto)){
        header("Location: ../views/cadastrar_gasto.php");
        exit;
    }

    echo "Erro ao salvar gasto";

}


/**O fluxo inteiro em código mental salvar_gasto.php
 * 
require conexao.php;
require Gasto.php;
require GastoRepository.php;

pega $_POST;

cria $gasto = new Gasto(...);

cria $repository = new GastoRepository($conn);

$repository->salvar($gasto);
Resumo do papel de cada um
salvar_gasto.php
= recebe o formulário
Gasto.php
= organiza os dados em um objeto
GastoRepository.php
= pega esse objeto e salva no banco
conexao.php
= cria a conexão $conn

A frase chave é:

O formulário manda dados soltos. O Model transforma em objeto. O Repository salva esse objeto no banco.
 */
?>