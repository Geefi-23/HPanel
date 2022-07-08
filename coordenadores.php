<?php
  require __DIR__ . '/vendor/autoload.php';
  
  use Utils\Authenticate;

  if (!Authenticate::authenticate()) 
	  header('Location: /painel/login');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HPainel | Coordenadores</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/functional-card.css">
</head>

<body>
  <?php require 'assets/components/sidebar.php'; ?>
  <div style="flex: 1">
    <?php require 'assets/components/header.php' ?>
    <main class="p-5">
      <h4>Coordenadores</h4>
      <div class="dashboard">
        <a href="coordenadores/membros" class="functional-card">
          <h4>Gerenciar membros</h4>
          <p>Destinado ao gerenciamento dos coordenadores do site.</p>
        </a>
        <a href="coordenadores/cargos" class="functional-card">
          <h4>Gerenciar cargos</h4>
          <p>Destinado ao gerenciamento de cargos.</p>
        </a>
        <a href="coordenadores/compras" class="functional-card">
          <h4>Gerenciar compras</h4>
          <p>Destinado ao gerenciamento de compras da HabbletXD.</p>
        </a>
      </div>
    </main>
  </div>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>

</html>