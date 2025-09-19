// Cálculo de financiamento (parcelas fixas)
function calcularFinanciamento() {
  let valor = parseFloat(document.getElementById("valor").value);
  let juros = parseFloat(document.getElementById("juros").value) / 100;
  let parcelas = parseInt(document.getElementById("parcelas").value);

  if (isNaN(valor) || isNaN(juros) || isNaN(parcelas)) {
    document.getElementById("resultado").innerText = "Preencha todos os campos corretamente.";
    return;
  }

  // Fórmula de amortização (Price)
  let parcela = (valor * juros) / (1 - Math.pow(1 + juros, -parcelas));

  document.getElementById("resultado").innerText =
    "Parcela mensal: R$ " + parcela.toFixed(2).replace('.', ',');
}

// Cálculo de investimento (juros compostos)
function calcularInvestimento() {
  let valor = parseFloat(document.getElementById("valorInvest").value);
  let juros = parseFloat(document.getElementById("jurosInvest").value) / 100;
  let meses = parseInt(document.getElementById("tempoInvest").value);

  if (isNaN(valor) || isNaN(juros) || isNaN(meses)) {
    document.getElementById("resultadoInvest").innerText = "Preencha todos os campos corretamente.";
    return;
  }

  // fórmula de juros compostos
  let montante = valor * Math.pow((1 + juros), meses);
  let lucro = montante - valor;

  document.getElementById("resultadoInvest").innerHTML =
    "Montante final: <strong>R$ " + montante.toFixed(2).replace('.', ',') +
    "</strong><br>Lucro: <strong>R$ " + lucro.toFixed(2).replace('.', ',') + "</strong>";
}