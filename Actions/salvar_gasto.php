<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $descricao = trim($_POST['descricao']);
    $categoria = trim($_POST['categoria']);
    $valor = (float) $_POST['valor'];
    $data = $_POST['data'];

}

?>