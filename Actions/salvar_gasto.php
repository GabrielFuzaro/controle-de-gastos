<?php 

require_once '../config/conexao.php';
require_once '../Models/Gasto.php';
require_once '../Repositories/GastoRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $descricao = trim($_POST['descricao']);
    $categoria = trim($_POST['categoria']);
    $valor = (float) $_POST['valor'];
    $data = $_POST['data'];

    $gasto = new Gasto($descricao, $categoria, $valor, $data);

    $repostitory = new GastoRepository($conn);

    if($repostitory->salvar($gasto)){
        header("Location: ../views/index.php");
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