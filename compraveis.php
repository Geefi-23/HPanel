<?php
  require './assets/backend/Token.php';
  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
    header('Location: /painel/login');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="assets/lib/editor/editor.js"></script>
  <link rel="stylesheet" href="assets/lib/editor/editor.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
  <!-- BOOTSTRAP 3 POR CAUSA DO EDITOR RICH TEXT DESATUALIZADO. ATUALIZE ASSIM QUE POSSIVEL -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/functional-card.css">

  <title>Noticias</title>
</head>
<body>
  <?php
    require 'assets/components/sidebar.php';
  ?>
  <main>
    <div class="dashboard">
      <a href="compraveis/postar" class="functional-card">
        <h4>Postar Comprável</h4>
        <span>Use esta área para postagem de compráveis.</span>
      </a>
      <a href="compraveis/postar-raro" class="functional-card">
        <h4>Postar Raro</h4>
        <span>Use esta área para postagem de raros.</span>
      </a>
      <a href="compraveis/gerenciar" class="functional-card">
        <h4>Gerenciar compráveis</h4>
        <span>Use esta área para gerenciar itens compráveis</span>
      </a>
    </div>
  </main>
</body>
</html>