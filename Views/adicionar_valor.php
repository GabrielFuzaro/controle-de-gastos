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
        <h1 class="text-white font-bold text-center text-5xl">Controle de gastos</h1>
    </header>
    <main class="flex flex-1 flex-col justify-center items-center bg-gray-800 text-white">
        <div class="bg-gray-900 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
            <h2 class="text-4xl font-bold">Adicionar Valor</h2>
            <form method="post" action="../Actions/salvar_extras.php" class="flex flex-col mt-5">
                <h3>Descrição</h3>
                <input type="text" name="descricao" class="border-white w-full p-3 border rounded-lg bg-gray-800" required>
                <h3>Valor</h3>
                <input type="number" name="valor" class="border-white w-full p-3 border rounded-lg bg-gray-800" required>
                <h3>Data</h3>
                <input type="date" name="data_entrada" class="border-white w-full p-3 border rounded-lg bg-gray-800" required>
                <input type="submit" class="w-1/3 mt-2 bg-blue-500 cursor-pointer font-bold text-lg hover:bg-blue-400 text-white py-1 rounded-lg transition">
            </form>
        </div>
    </main>
     <footer class="bg-gray-900 py-1">
        <p class="text-center text-gray-400">Feito por Gabriel Fuzaro no dia 09/06/2026</p>
    </footer>
</body>
</html>