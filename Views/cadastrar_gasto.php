<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/assets/css/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-gray-900 flex flex-col min-h-screen">
    <header class="py-5">
        <h1 class="text-white font-bold text-center text-3xl lg:text-5xl">Controle de gastos</h1>
    </header>
    <main class="flex flex-1 flex-col justify-center items-center bg-gray-800 text-white px-4 lg:px-0">
        <div class="w-full lg:w-1/3 my-5">
            <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
                <div>
                    <form class="gap-1.5 flex flex-col w-full lg:w-auto" method="post" action="../Actions/salvar_gasto.php">
                        <h3>Descrição</h3>
                        <input class="border-white w-full p-3 border text-center rounded-lg bg-gray-800" type="text" name="descricao" minlength="2" maxlength="21" required>
                        <h3>Categoria</h3>
                        <select class="bg-gray-800 w-full p-3 border border-white rounded-lg cursor-pointer" name="categoria">
                            <option value="" selected disabled>Selecione uma categoria</option>
                            <option>Alimentação</option>
                            <option>Transporte</option>
                            <option>Investimentos</option>
                            <option>Minhas Coisas</option>
                            <option>Presentes</option>
                        </select>
                        <h3>Valor</h3>
                        <input class="border-white w-full p-3 border rounded-lg bg-gray-800" type="number" name="valor" min='0' required>
                        <h3>Data</h3>
                        <input class="border-white w-full p-3 border rounded-lg bg-gray-800 mb-3" type="date" name="data" required>
                        <br>
                        <button class="w-full bg-blue-500 cursor-pointer font-bold text-2xl hover:bg-blue-400 text-white py-3 rounded-lg transition">Adicionar</button>
                    </form>
                </div>
            </div>
            <a href="./dashboard.php" class="self">
                <button class="bg-gray-700 w-auto lg:w-1/4 cursor-pointer rounded-4xl font-bold text-lg mt-4 hover:bg-gray-900 text-white py-3 transition">Dashboard</button>
            </a>
        </div>
    </main>
    <footer class="bg-gray-900 py-1">
        <p class="text-center text-gray-400">Feito por Gabriel Fuzaro no dia 09/06/2026</p>
    </footer>
</body>
</html>
