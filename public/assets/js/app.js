const formExcluir = document.querySelectorAll(".form-excluir");

 formExcluir.forEach(function (formulario) {
    formulario.addEventListener("submit", function (event) {
        const confirmar = confirm("Tem certeza que deseja excluir?");

        if (!confirmar) {
            event.preventDefault();
        }
    })
 }) 

 const limparBusca = document.querySelector("#limpar-busca")
 const mensagemQuantidadeGastos = document.querySelector("#quantidade-de-gastos")
 const mensagemSemGastos = document.querySelector("#mensagem-sem-gastos")
 const inputBuscarGasto = document.querySelector("#buscar-gasto");
 const linhasGasto = document.querySelectorAll(".linha-gasto");

 inputBuscarGasto.addEventListener("input", function () {
    const textoBusca = inputBuscarGasto.value.toLowerCase();

    let quantidadeDeLinhas = 0

    linhasGasto.forEach(function (linha) {
        const textoLinha = linha.textContent.toLowerCase().trim();

        if (textoLinha.includes(textoBusca)) {
            linha.style.display ="";
            quantidadeDeLinhas++;
        } else {
            linha.style.display = "none";
        }
    })

    if (quantidadeDeLinhas === 0) {
        mensagemSemGastos.style.display = "block";
        mensagemQuantidadeGastos.style.display = "none"
    } else {
        mensagemSemGastos.style.display = "none";
        mensagemQuantidadeGastos.style.display = "block";
        mensagemQuantidadeGastos.textContent = "Gastos Encontrados: " + quantidadeDeLinhas;
    }
 })
 limparBusca.addEventListener("click", function () {
    inputBuscarGasto.value = "";

    linhasGasto.forEach(function (linha) {
        linha.style.display = "";
    });
    mensagemSemGastos.style.display = "none";
    mensagemQuantidadeGastos.style.display = "none";
   });



