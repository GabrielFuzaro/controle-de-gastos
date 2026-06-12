<?php
session_start();
 
require "../config/conexao.php";
require "../Repositories/GastoRepository.php";
require "../Repositories/ExtraRepository.php";
 
$repository = new GastoRepository($conn);
$repository_entrada = new ExtraRepository($conn);
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['salario']) && $_POST['salario'] !== '') {
        $_SESSION['salario'] = (float) $_POST['salario'];
    }
}
 
$salario = $_SESSION['salario'] ?? 0;
$mes = $_GET['mes'] ?? null;
 
$meses = [
    1  => 'Janeiro',
    2  => 'Fevereiro',
    3  => 'Março',
    4  => 'Abril',
    5  => 'Maio',
    6  => 'Junho',
    7  => 'Julho',
    8  => 'Agosto',
    9  => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];
 
if ($mes) {
    $maiorGasto          = $repository->buscarMaiorGastoMes($mes);
    $categoriaMaisGasta  = $repository->buscarCategoriaMaisGastaMes($mes);
    $quantidadeDeGastos  = $repository->contarGastosMes($mes);
    $totalExtra          = $repository_entrada->somarPorMes($mes);
    $extras              = $repository_entrada->listarExtraPorMes($mes);
    $gastos              = $repository->listarPorMes($mes);
    $totalGasto          = $repository->somarPorMes($mes);
    $gastosPorCategoria  = $repository->somarPorCategoriaMes($mes);
} else {
    $maiorGasto          = $repository->buscarMaiorGasto();
    $categoriaMaisGasta  = $repository->buscarCategoriaMaisGasta();
    $quantidadeDeGastos  = $repository->contarGastos();
    $totalExtra          = $repository_entrada->somar();
    $extras              = $repository_entrada->listarExtra();
    $gastos              = $repository->listar();
    $totalGasto          = $repository->somar();
    $gastosPorCategoria  = $repository->somarPorCategoria();
}
 
$total = $totalExtra + $salario;
$saldo = $total - $totalGasto;
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/assets/css/output.css" rel="stylesheet">
    <title>View</title>
</head>
<body class="bg-gray-900 flex flex-col min-h-screen">
 
    <header class="py-5">
        <h1 class="text-white font-bold text-center text-3xl lg:text-5xl">Controle de gastos</h1>
    </header>
 
    <main class="flex flex-1 flex-col justify-center items-center bg-gray-800 text-white px-4 lg:px-0">
 
        <!-- FILTRO -->
        <div>
            <div>
                <h2 class="font-bold mt-2">Filtrar por mês</h2>
            </div>
            <div class="flex gap-2">
                <img src="../public/assets/img/filtro.png">
                <form method="GET" action="">
                    <select name="mes" class="bg-gray-800 text-white">
                        <option value="" <?= $mes == '' ? 'selected' : '' ?>>Nenhum</option>
                        <?php foreach ($meses as $numero => $nome): ?>
                            <option value="<?= $numero ?>" <?= $mes == $numero ? 'selected' : '' ?>>
                                <?= $nome ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="mt-2 bg-gray-600 cursor-pointer font-bold text-lg text-center px-2 hover:bg-gray-500 text-white rounded-lg transition">
                        Filtrar
                    </button>
                </form>
            </div>
        </div>
 
        <!-- GRID PRINCIPAL -->
        <div class="w-full lg:w-5/6 mt-6">
            <div class="gap-6 grid grid-cols-1 lg:grid-cols-2">
 
                <!-- COLUNA ESQUERDA -->
                <div class="flex flex-col gap-6">
 
                    <!-- SALÁRIO / TOTAL / SALDO -->
                    <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
                        <div class="flex flex-col justify-center items-center">
                            <div class="flex flex-col lg:flex-row gap-8">
                                <div>
                                    <h2 class="font-bold text-2xl">Salário</h2>
                                    <form method="post" action="">
                                        <input name="salario" type="text" class="border-white w-4/5 p-3 border rounded-lg bg-gray-800" required value="<?= $salario ?>">
                                        <br>
                                        <input type="submit" class="w-1/3 mt-2 bg-blue-500 cursor-pointer font-bold text-lg hover:bg-blue-400 text-white py-1 rounded-lg transition">
                                    </form>
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-2xl font-bold">TOTAL GASTO</h2>
                                    <p class="text-3xl font-bold text-green-400"><?= "R$" . $totalGasto ?></p>
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-2xl font-bold">TOTAL</h2>
                                    <p class="text-3xl font-bold text-green-400"><?= "R$" . $total ?></p>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-4xl font-bold">Saldo</h2>
                                <p class="text-blue-500 text-3xl font-bold"><?= "R$" . $saldo ?></p>
                            </div>
                        </div>
                    </div>
 
                    <!-- TABELA DE GASTOS -->
                    <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
                        <div class="h-auto bg-gray-900 mt-3 w-full overflow-x-auto">
                            <table class="w-130 text-center">
                                <thead>
                                    <tr>
                                        <th>Excluir</th>
                                        <th>Descrição</th>
                                        <th>Categoria</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($gastos as $gasto): ?>
                                        <tr>
                                            <td class="border border-white">
                                                <form method="post" action="../Actions/excluir_gasto.php">
                                                    <input type="hidden" name="id" value="<?= $gasto['id'] ?>">
                                                    <button class="cursor-pointer mt-1" type="submit">
                                                        <img src="../public/assets/img/delete_24dp_EA3323_FILL0_wght400_GRAD0_opsz24.png">
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="border border-white"><?= $gasto['descricao'] ?></td>
                                            <td class="border border-white"><?= $gasto['categoria'] ?></td>
                                            <td class="border border-white"><?= $gasto['valor'] ?></td>
                                            <td class="border border-white"><?= $gasto['data_gasto'] ?></td>
                                            <td class="border border-white">
                                                <a href="./editar_gasto.php?id=<?= $gasto['id'] ?>">
                                                    <button class="cursor-pointer mt-1">
                                                        <img src="../public/assets/img/edit.png">
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
 
                </div>
 
                <!-- COLUNA DIREITA -->
                <div class="flex flex-col gap-6">
 
                    <!-- ESTATÍSTICAS -->
                    <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
                        <h2 class="text-4xl font-bold text-center mb-8">Estatísticas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-800 rounded-2xl p-5 border border-gray-700">
                                <p class="text-gray-400 font-bold">Quantidade de Gastos</p>
                                <p class="text-4xl font-bold text-blue-400"><?= $quantidadeDeGastos ?></p>
                            </div>
                            <div class="bg-gray-800 rounded-2xl p-5 border border-gray-700">
                                <p class="text-gray-400 font-bold">Categoria mais Gasta</p>
                                <p class="text-2xl font-bold text-yellow-400"><?= $categoriaMaisGasta['categoria'] ?? 'Nenhuma' ?></p>
                            </div>
                            <div class="bg-gray-800 rounded-2xl p-5 border border-gray-700">
                                <p class="text-gray-400 font-bold">Maior Gasto</p>
                                <p class="text-4xl font-bold mt-3 text-green-400">R$<?= $maiorGasto ?></p>
                            </div>
                        </div>
                    </div>
 
                    <!-- GASTO POR CATEGORIA -->
                    <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
                        <h2 class="font-bold text-2xl">Gasto por categoria</h2>
                        <div class="h-auto bg-gray-900 mt-3 w-full overflow-x-auto">
                            <table class="w-105 text-center">
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($gastosPorCategoria as $categoria): ?>
                                        <tr>
                                            <td class="border border-white"><?= $categoria['categoria'] ?></td>
                                            <td class="border border-white"><?= $categoria['total'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
 
                    <!-- VALORES EXTRAS -->
                    <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
                        <h2 class="text-4xl font-bold">Valores Extras</h2>
                        <div class="h-auto bg-gray-900 mt-3 w-full overflow-x-auto">
                            <table class="w-110 text-center">
                                <thead>
                                    <tr>
                                        <th>Excluir</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($extras as $extra): ?>
                                        <tr>
                                            <td class="border border-white">
                                                <form method="post" action="../Actions/excluir_extra.php">
                                                    <input type="hidden" name="id" value="<?= $extra['id'] ?>">
                                                    <button class="cursor-pointer mt-1" type="submit">
                                                        <img src="../public/assets/img/delete_24dp_EA3323_FILL0_wght400_GRAD0_opsz24.png">
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="border border-white"><?= $extra['descricao'] ?></td>
                                            <td class="border border-white"><?= $extra['valor'] ?></td>
                                            <td class="border border-white"><?= $extra['data_entrada'] ?></td>
                                            <td class="border border-white">
                                                <a href="./editar_extra.php?id=<?= $extra['id'] ?>">
                                                    <button class="cursor-pointer mt-1">
                                                        <img src="../public/assets/img/edit.png">
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
 
                </div>
 
            </div>
 
            <!-- BOTÕES -->
            <div class="flex flex-col lg:flex-row justify-between w-full gap-4 mb-6">
                <a href="./cadastrar_gasto.php">
                    <button class="w-full lg:w-auto bg-gray-700 mb-5 mt-5 cursor-pointer rounded-4xl py-3 px-6 font-bold text-lg hover:bg-gray-900 text-white transition">
                        Cadastrar Gasto
                    </button>
                </a>
                <a href="./adicionar_valor.php">
                    <button class="w-full lg:w-auto bg-gray-700 mb-5 mt-5 cursor-pointer rounded-4xl py-3 px-6 font-bold text-lg hover:bg-gray-900 text-white transition">
                        Adicionar Valor
                    </button>
                </a>
            </div>
 
        </div>
 
    </main>
 
    <footer class="bg-gray-900 py-1">
        <p class="text-center text-gray-400">Feito por Gabriel Fuzaro no dia 09/06/2026</p>
    </footer>
 
</body>
</html>
