const formExcluir = document.querySelectorAll(".form-excluir");

 formExcluir.forEach(function (formulario) {
    formulario.addEventListener("submit", function (event) {

        const formTr = formulario.closest("tr")
        const formNome = formTr.querySelector(" .form-nome")
        const formNomeExcluir = formNome.textContent
        const confirmar = confirm("Tem certeza que deseja excluir " + formNomeExcluir + '?');

        if (!confirmar) {
            event.preventDefault();
        }
    })
 }) 

 const mensagemValorEncontrados = document.querySelector("#total-de-gastos")
 const limparBusca = document.querySelector("#limpar-busca")
 const mensagemQuantidadeGastos = document.querySelector("#quantidade-de-gastos")
 const mensagemSemGastos = document.querySelector("#mensagem-sem-gastos")
 const inputBuscarGasto = document.querySelector("#buscar-gasto");
 const linhasGasto = document.querySelectorAll(".linha-gasto");

 inputBuscarGasto.addEventListener("input", function () {
    const textoBusca = inputBuscarGasto.value.toLowerCase();

    let quantidadeDeLinhas = 0
    let totalGastos = 0

    linhasGasto.forEach(function (linha) {
        const textoLinha = linha.textContent.toLowerCase().trim();

        if (textoLinha.includes(textoBusca)) {
            linha.style.display ="";
            quantidadeDeLinhas++;

            const formTrValor = linha.closest("tr")
            const formValor = formTrValor.querySelector(" .form-valor")
            const valorNumero = Number(formValor.textContent)
            totalGastos += valorNumero
        } else {
            linha.style.display = "none";
        }
    })

    if (quantidadeDeLinhas === 0) {
        mensagemSemGastos.style.display = "block";
        mensagemQuantidadeGastos.style.display = "none"
        mensagemValorEncontrados.style.display = "none"
    } else {
        mensagemValorEncontrados.style.display = "block"
        mensagemValorEncontrados.textContent = `Valor total dos Gastos Encontados: R$${totalGastos}`
        mensagemSemGastos.style.display = "none";
        mensagemQuantidadeGastos.style.display = "block";
        mensagemQuantidadeGastos.textContent = `Gastos Encontrados: ${quantidadeDeLinhas}`;
    }
 })
 limparBusca.addEventListener("click", function () {
    inputBuscarGasto.value = "";

    linhasGasto.forEach(function (linha) {
        linha.style.display = "";
    });
    mensagemValorEncontrados.style.display = "none"
    mensagemSemGastos.style.display = "none";
    mensagemQuantidadeGastos.style.display = "none";
   });



