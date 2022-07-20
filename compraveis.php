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
  <script src="assets/lib/editor/editor.js"></script>
  
  <link rel="stylesheet" href="assets/lib/editor/editor.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/functional-card.css">

  <title>HPainel | Compráveis</title>
</head>
<body>
  <?php
    require 'assets/components/sidebar.php';
  ?>
  <div style="flex: 1">
    <?php require 'assets/components/header.php' ?>
    <main class="p-5">
      <h4>Compráveis</h4>
      <div class="dashboard">
        <a href="compraveis/postar" class="functional-card">
          <h4>Postar Comprável</h4>
          <span>Use esta área para postagem de compráveis.</span>
        </a>
        <a href="compraveis/postar-valor" class="functional-card">
          <h4>Postar Valor</h4>
          <span>Use esta área para postagem de valores.</span>
        </a>
        <a href="compraveis/gerenciar" class="functional-card">
          <h4>Gerenciar compráveis</h4>
          <span>Use esta área para gerenciar itens compráveis.</span>
        </a>
        <a href="compraveis/gerenciar-valores" class="functional-card">
          <h4>Gerenciar valores</h4>
          <span>Use esta área para gerenciar os valores do site.</span>
        </a>
      </div>
    </main>
  </div>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>
</html>