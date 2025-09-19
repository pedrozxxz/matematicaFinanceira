<?php
// Somente para desenvolvimento — remove em produção
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Simulador de Financiamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <?php include_once __DIR__ . '/navbar.php'; ?>

  <div class="container py-5">
    <div class="text-center mb-4">
      <h1 class="display-5 fw-bold text-primary">🏠 Simulador de Financiamento</h1>
      <p class="text-muted">Calcule as parcelas e visualize a evolução do seu financiamento</p>
    </div>

    <div class="card shadow-lg mb-4">
      <div class="card-body">
        <form class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Tipo de Financiamento</label>
            <select id="tipoFinanciamento" class="form-select" onchange="ajustarJuros()">
              <option value="imobiliario">Imobiliário</option>
              <option value="veicular">Veicular</option>
              <option value="pessoal">Pessoal</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Valor Total (R$)</label>
            <input type="number" id="valor" class="form-control" value="10000">
          </div>
          <div class="col-md-4">
            <label class="form-label">Prazo (meses)</label>
            <input type="number" id="parcelas" class="form-control" value="60">
          </div>
          <div class="col-md-4">
            <label class="form-label">Juros (% a.m.)</label>
            <input type="number" id="juros" class="form-control" value="0.8" step="0.01">
          </div>
          <div class="col-12">
            <button type="button" onclick="calcular()" class="btn btn-primary btn-lg w-100">Calcular</button>
          </div>
        </form>
      </div>
    </div>

    <div id="resultado" class="card shadow-lg p-4 mb-4"></div>
    <div class="card shadow-lg p-4">
      <canvas id="graficoLinha"></canvas>
    </div>
  </div>

  <!-- Footer -->
  <?php include_once __DIR__ . '/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // Função para ajustar automaticamente os juros conforme o tipo de financiamento
  function ajustarJuros() {
    const tipo = document.getElementById("tipoFinanciamento").value;
    const jurosInput = document.getElementById("juros");

    switch(tipo) {
      case 'imobiliario': 
        jurosInput.value = 0.8; 
        break;
      case 'veicular': 
        jurosInput.value = 1.2; 
        break;
      case 'pessoal': 
        jurosInput.value = 1.8; 
        break;
    }
  }

  function calcular() {
    let tipo = document.getElementById("tipoFinanciamento").value;
    let valor = parseFloat(document.getElementById("valor").value);
    let juros = parseFloat(document.getElementById("juros").value)/100;
    let parcelas = parseInt(document.getElementById("parcelas").value);

    // Ajuste de juros por tipo (opcional)
    switch(tipo) {
      case 'imobiliario': juros = juros; break;
      case 'veicular': juros = juros + 0.2; break; // exemplo: veicular +0,2%
      case 'pessoal': juros = juros + 0.5; break;   // exemplo: pessoal +0,5%
    }

    let pmt = (valor*juros)/(1 - Math.pow(1+juros,-parcelas));
    let saldo = valor;
    let labels = [];
    let saldos = [];

    for(let i=1;i<=parcelas;i++){
      let jurosMes = saldo*juros;
      let amortizacao = pmt-jurosMes;
      saldo -= amortizacao;
      labels.push("Mês "+i);
      saldos.push(saldo>0? saldo:0);
    }

    document.getElementById("resultado").innerHTML = `
      <h3 class="text-primary">Resultados da Simulação (${tipo.charAt(0).toUpperCase() + tipo.slice(1)})</h3>
      <p><strong>Parcela:</strong> R$ ${pmt.toFixed(2)}</p>
      <p><strong>Custo total:</strong> R$ ${(pmt*parcelas).toFixed(2)}</p>
      <p><strong>Total de Juros:</strong> R$ ${((pmt*parcelas)-valor).toFixed(2)}</p>
      <p><strong>Taxa de juros aplicada:</strong> ${(juros*100).toFixed(2)}% ao mês</p>
    `;

    new Chart(document.getElementById("graficoLinha"), {
      type:'line',
      data:{
        labels:labels,
        datasets:[{
          label:'Saldo Devedor',
          data:saldos,
          borderColor:'#007bff',
          fill:false
        }]
      },
      options: {
        responsive:true,
        plugins: { legend:{display:true} }
      }
    });
  }
  
  // Inicializar com os juros do tipo selecionado por padrão
  window.onload = function() {
    ajustarJuros();
  };
  </script>
</body>
</html>