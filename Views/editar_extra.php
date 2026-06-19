<?php

session_start(); 

require_once '../config/conexao.php';
require_once '../Repositories/ExtraRepository.php';

$conn = getConnection();

$repository = new ExtraRepository($conn);

$id = $_GET['id'];

$extra = $repository->buscarPorId($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/assets/css/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-gray-900 flex flex-col h-screen">
    <header class="py-5">
        <h1 class="text-white font-bold text-center text-5xl">Editar Valor Extra</h1>
    </header>
    <main class="flex flex-1 flex-col justify-center items-center bg-gray-800 text-white">
        <div class="w-1/3 my-5">
            <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
                <div class="">
                    <form class=" gap-1.5 flex flex-col" method="post" action="../Actions/salvar_editar_extra.php">
                        <input type="hidden" name="id" value="<?= $extra['id'] ?>">
                        <h3>Descrição</h3>
                        <input class="border-white w-full p-3 border text-center rounded-lg bg-gray-800" minlength="2" maxlength="21" type="text" name="descricao" required value="<?= $extra['descricao'] ?>">
                        <h3>Valor</h3>
                        <input class="border-white w-full p-3 border rounded-lg bg-gray-800" type="number" name="valor" min="0" required value="<?= $extra['valor'] ?>">
                        <h3>Data</h3>
                        <input class="border-white w-full p-3 border rounded-lg bg-gray-800 mb-3" type="date" name="data" required value="<?= $extra['data_entrada'] ?>">
                        <br>
                        <button class="w-full bg-blue-500 cursor-pointer font-bold text-2xl hover:bg-blue-400 text-white py-3 rounded-lg transition">Salvar</button>
                    </form>
                </div>
            </div>
            <a href="./dashboard.php" class="self">
                <button class="bg-gray-700 w-1/4 cursor-pointer rounded-4xl font-bold text-lg mt-4 hover:bg-gray-900 text-white py-3 transition">Dashboard</button>
            </a>
        </div>
    </main>
    <footer class="bg-gray-900 py-1">
        <p class="text-center text-gray-400">Feito por Gabriel Fuzaro no dia 09/06/2026</p>
    </footer>
</body>
</html>