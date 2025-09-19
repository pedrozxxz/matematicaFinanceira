<?php 
include("db.php");

// Somente para desenvolvimento — remove em produção
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Gerenciador de Despesas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">

  <!-- Navbar -->
  <?php include_once __DIR__ . '/navbar.php'; ?>

  <div class="container py-5">
    <div class="text-center mb-4">
      <h1 class="display-5 fw-bold text-primary">💰 Gerenciador de Despesas</h1>
      <p class="text-muted">Controle suas finanças de forma simples e eficiente</p>
    </div>

    <?php
      $totalEntradas = 0;
      $totalSaidas = 0;
      $sql = "SELECT * FROM despesas";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc()){
          if($row['valor'] >= 0){
              $totalEntradas += $row['valor'];
          } else {
              $totalSaidas += $row['valor'];
          }
      }
      $total = $totalEntradas + $totalSaidas;
    ?>

    <!-- Cards Resumo -->
    <div class="row text-center mb-4">
      <div class="col-md-4 mb-3">
        <div class="card border-success shadow-sm">
          <div class="card-body">
            <h5>Entradas</h5>
            <h3 class="text-success">R$ <?= number_format($totalEntradas,2,",",".") ?></h3>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card border-danger shadow-sm">
          <div class="card-body">
            <h5>Saídas</h5>
            <h3 class="text-danger">R$ <?= number_format($totalSaidas,2,",",".") ?></h3>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card border-primary shadow-sm">
          <div class="card-body">
            <h5>Saldo</h5>
            <h3 class="<?= $total>=0 ? 'text-primary' : 'text-danger' ?>">R$ <?= number_format($total,2,",",".") ?></h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulário Nova Despesa -->
    <div class="card shadow-lg mb-4">
      <div class="card-header bg-primary text-white">Adicionar Nova Transação</div>
      <div class="card-body">
        <form method="POST" action="despesas_processa.php" class="row g-3">
          <div class="col-md-4">
            <input type="text" name="descricao" class="form-control" placeholder="Descrição" required>
          </div>
          <div class="col-md-2">
            <input type="number" step="0.01" name="valor" class="form-control" placeholder="Valor" required>
          </div>
          <div class="col-md-3">
            <select name="categoria" class="form-select">
              <option>Moradia</option>
              <option>Alimentação</option>
              <option>Transporte</option>
              <option>Lazer</option>
              <option>Saúde</option>
              <option>Educação</option>
              <option>Salário</option>
              <option>Investimentos</option>
              <option>Outros</option>
            </select>
          </div>
          <div class="col-md-3">
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success">Adicionar Transação</button>
            </div>
          </div>
          <div class="col-12">
            <small class="text-muted">Use valores positivos para entradas e negativos para saídas (ex: -150.00)</small>
          </div>
        </form>
      </div>
    </div>

    <!-- Lista de Transações -->
    <div class="card shadow-lg mb-4">
      <div class="card-header bg-light">
        <h3 class="mb-0">Histórico de Transações</h3>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>Descrição</th>
                <th>Categoria</th>
                <th class="text-end">Valor</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM despesas ORDER BY id DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){
                      $classe = $row['valor'] >=0 ? 'text-success' : 'text-danger';
                      $icone = $row['valor'] >=0 ? '📈' : '📉';
                      echo "<tr>
                              <td>$icone {$row['descricao']}</td>
                              <td><span class='badge bg-secondary'>{$row['categoria']}</span></td>
                              <td class='text-end $classe fw-bold'>R$ ".number_format($row['valor'],2,",",".")."</td>
                              <td>{$row['data_registro']}</td>
                            </tr>";
                  }
                } else {
                  echo "<tr><td colspan='4' class='text-center py-4 text-muted'>Nenhuma transação registrada ainda.</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Gráfico -->
    <div class="card shadow-lg">
      <div class="card-header bg-light">
        <h4 class="mb-0">Resumo Visual</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <canvas id="grafico" height="250"></canvas>
          </div>
          <div class="col-md-6">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div>
                <h5 class="text-center">Distribuição por Categoria</h5>
                <div class="text-center text-muted">
                  <small>Use o gráfico para visualizar o equilíbrio entre entradas e saídas</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include_once __DIR__ . '/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const ctx = document.getElementById('grafico');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Entradas','Saídas'],
        datasets: [{
          label: 'Valores',
          data: [<?= $totalEntradas ?>, <?= abs($totalSaidas) ?>],
          backgroundColor: ['#28a745','#dc3545'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: { boxWidth: 20, font: { size: 14 } }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return context.label + ': R$ ' + context.raw.toFixed(2).replace('.', ',');
              }
            }
          }
        },
        cutout: '60%'
      }
    });
  </script>
</body>
</html>