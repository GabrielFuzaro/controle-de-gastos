<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/assets/css/output.css" rel="stylesheet">
    <title>View</title>
</head>
<body class="bg-gray-900 flex flex-col h-screen">
    <header class="py-5">
        <h1 class="text-white font-bold text-center text-5xl">Controle de gastos</h1>
    </header>
    <main class="flex flex-1 flex-col justify-center items-center bg-gray-800 text-white">
        <div class="bg-gray-900 w-1/3 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl my-5">
            <div class="flex flex-col">
                <h2 class="text-2xl font-bold">Total gasto</h2>
                <p class="text-5xl font-bold text-green-400">R$ 0,00</p>
            </div>
        </div>
        <div class="bg-gray-900 w-1/3 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl">
            <div class="">
                <form class="gap-3 flex flex-col" method="post" action="../Actions/salvar_gasto.php">
                    <h3>Descrição</h3>
                    <input class="border-white w-full p-3 border-1 text-center rounded-lg bg-gray-800" type="text" name="descricao">
                    <h3>Categoria</h3>
                    <select class="bg-gray-800 w-full p-3 border border-white rounded-lg" name="categoria">
                        <option></option>
                    </select>
                    <h3>Valor</h3>
                    <input class="border-white w-full p-3 border-1 rounded-lg bg-gray-800" type="number" name="valor">
                    <h3>Data</h3>
                    <input class="border-white w-full p-3 border-1 rounded-lg bg-gray-800 mb-3" type="date" name="data">
                    <br>
                    <button class="w-full bg-blue-500 hover:bg-blue-100 text-white py-3 rounded-lg transition">Adicionar</button>
                </form>
            </div>
        </div>
        <div class="bg-gray-900 w-1/3 h-auto flex flex-col justify-center items-center px-10 py-8 rounded-3xl shadow-2xl mt-5">
         <div class="h-auto bg-gray-900 w-f1/3 mt-3">
                <table class="w-full text-center">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Data</th>
                        </tr>
                    </thead>    
                </table>
            </div>
        </div>
    </main>
    <footer class="bg-gray-900">
        <p>eeu</p>
    </footer>
</body>
</html>