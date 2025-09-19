<?php
// Somente para desenvolvimento — remove em produção
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// carrega conexão / configurações do banco (ajuste o caminho se necessário)
require_once __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Simulador de Investimentos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/script.js" defer></script>
</head>
<body class="bg-light">

  <!-- Navbar (include seguro com caminho absoluto relativo ao arquivo atual) -->
  <?php include_once __DIR__ . '/navbar.php'; ?>

  <div class="container py-5">
    <div class="text-center mb-4">
      <h1 class="display-5 fw-bold text-primary">📈 Simulador de Investimento</h1>
      <p class="text-muted">Descubra quanto seu dinheiro pode render ao longo do tempo</p>
    </div>

    <div class="card shadow-lg mx-auto" style="max-width: 500px;">
      <div class="card-body">
        <form onsubmit="event.preventDefault(); calcularInvestimento();" class="row g-3">

          <div class="col-12">
            <label class="form-label">Tipo de Investimento</label>
            <select id="tipoInvest" class="form-select" onchange="ajustarJuros()">
              <option value="rendaFixa">Renda Fixa</option>
              <option value="fundoImobiliario">Fundo Imobiliário</option>
              <option value="cdb">CDB</option>
              <option value="lciLca">LCI / LCA</option>
              <option value="acoes">Ações</option>
            </select>
          </div>

          <div class="col-12">
            <label class="form-label">Valor Inicial (R$)</label>
            <input type="number" id="valorInvest" class="form-control" placeholder="Ex: 1000" required>
          </div>

          <div class="col-12">
            <label class="form-label">Taxa de Juros (% ao mês)</label>
            <input type="number" id="jurosInvest" class="form-control" placeholder="Ex: 1" step="0.01" required>
          </div>

          <div class="col-12">
            <label class="form-label">Meses</label>
            <input type="number" id="tempoInvest" class="form-control" placeholder="Ex: 12" required>
          </div>

          <div class="col-12 d-grid">
            <button type="submit" class="btn btn-primary btn-lg">Calcular</button>
          </div>
        </form>

        <hr>
        <div class="text-center">
          <h4 class="text-success" id="resultadoInvest"></h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include_once __DIR__ . '/footer.php'; ?>

<script>
// Ajuste automático da taxa de juros conforme tipo
function ajustarJuros() {
  const tipo = document.getElementById("tipoInvest").value;
  const jurosInput = document.getElementById("jurosInvest");

  switch(tipo) {
    case 'rendaFixa': jurosInput.value = 0.8; break;
    case 'fundoImobiliario': jurosInput.value = 1.0; break;
    case 'cdb': jurosInput.value = 0.9; break;
    case 'lciLca': jurosInput.value = 0.75; break;
    case 'acoes': jurosInput.value = 1.5; break;
  }
}

// Função principal
function calcularInvestimento(){
  let valor = parseFloat(document.getElementById("valorInvest").value);
  let juros = parseFloat(document.getElementById("jurosInvest").value)/100;
  let meses = parseInt(document.getElementById("tempoInvest").value);

  let montante = valor * Math.pow((1 + juros), meses);
  document.getElementById("resultadoInvest").innerText =
    "Montante final: R$ " + montante.toFixed(2);
}
</script>

</body>
</html>