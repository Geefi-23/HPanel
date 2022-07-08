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

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/colors.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="assets/css/loader.css">
  <link rel="stylesheet" href="assets/css/notifications.css">
  <link rel="stylesheet" href="assets/css/functional-card.css">

  <title>HPainel | HabbletXD Home</title>
</head>
<body>
  <?php require 'assets/components/sidebar.php' ?>
  <div style="flex: 1">
    <?php require 'assets/components/header.php' ?>
    <main class="p-5">
      <h4>HabbletXD - Home</h4>
      <p>Área destinada para configurar a home da HabbletXD</p>
      <div class="dashboard">
        <a href="habbletxd-home/destaques" class="functional-card">
          <h4>Configurar destaques</h4>
          <span>Use esta área para configurar os destaques da home.</span>
        </a>
      </div>
    </main>
  </div>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>
</html>