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
  <title>Educação Financeira</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">

  <!-- Navbar -->
  <?php include_once __DIR__ . '/navbar.php'; ?>

  <!-- Hero Section -->
  <section class="hero bg-primary text-white py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="display-4 fw-bold">Educação sobre Juros, Dívidas e Investimentos</h1>
          <p class="lead">Entenda juros, controle suas dívidas e faça investimentos inteligentes.</p>
        </div>
        <div class="col-lg-6 text-center">
          <img src="https://cdn-icons-png.flaticon.com/512/1170/1170576.png" alt="Economia" class="img-fluid" style="max-height: 300px;">
        </div>
      </div>
    </div>
  </section>

  <!-- Artigos -->
  <section class="articles py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <article class="card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
              <img src="https://cdn-icons-png.flaticon.com/512/4221/4221373.png" alt="Juros" class="img-fluid mb-3" style="max-height: 100px;">
              <h2 class="h4">O que são Juros?</h2>
              <p>Juros são a remuneração paga pelo uso do dinheiro emprestado. Podem ser simples ou compostos.</p>
              <p><strong>Juros Compostos:</strong> incidem sobre o valor inicial mais os juros acumulados.</p>
              <p><strong>Juros Simples:</strong> incidem apenas sobre o valor inicial.</p>
            </div>
          </article>
        </div>
        
        <div class="col-md-4 mb-4">
          <article class="card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
              <img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" alt="Dívidas" class="img-fluid mb-3" style="max-height: 100px;">
              <h2 class="h4">Como controlar Dívidas?</h2>
              <p>Planeje suas despesas, priorize dívidas com maiores juros, renegocie condições e evite novos gastos desnecessários.</p>
              <p><strong>Estratégias:</strong> método bola de neve, método avalanche, e criação de reserva de emergência.</p>
            </div>
          </article>
        </div>
        
        <div class="col-md-4 mb-4">
          <article class="card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
              <img src="https://cdn-icons-png.flaticon.com/512/1170/1170591.png" alt="Investimentos" class="img-fluid mb-3" style="max-height: 100px;">
              <h2 class="h4">Investimentos Inteligentes</h2>
              <p>Renda fixa, fundos imobiliários, ações: conheça os riscos e benefícios de cada opção antes de investir.</p>
              <p>Invista regularmente e diversifique sua carteira para reduzir riscos.</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- Vídeos explicativos -->
  <section id="videos" class="videos py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5">Vídeos Explicativos</h2>
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/MgAQXEtWZEk?si=y4Qh6rbzfgVhOABE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="card-body">
              <h5 class="card-title">Entendendo Juros</h5>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="ratio ratio-16x9">
              <iframe width="560" height="315" src="https://www.youtube.com/embed/KuRZucr-YLE?si=pk3ZCMB8pG0wKl1_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="card-body">
              <h5 class="card-title">Como Controlar Dívidas</h5>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="ratio ratio-16x9">
             <iframe width="560" height="315" src="https://www.youtube.com/embed/qpTVQ616wok?si=Kmbf570DdHGjBfgn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="card-body">
              <h5 class="card-title">Investimentos para Iniciantes</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include_once __DIR__ . '/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>