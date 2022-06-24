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
  <title>HPainel | Coordenadores</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/functional-card.css">
</head>

<body>
  <?php require 'assets/components/sidebar.php'; ?>
  <main>
    <div class="dashboard">
      <a href="coordenadores/membros" class="functional-card">
        <h4>Gerenciar membros</h4>
        <p>Destinado ao gerenciamento dos coordenadores do site.</p>
      </a>
      <a href="coordenadores/cargos" class="functional-card">
        <h4>Gerenciar cargos</h4>
        <p>Destinado ao gerenciamento de cargos e permissões.</p>
      </a>
    </div>
  </main>
  <script src="assets/js/team_members.js" type="module"></script>
</body>

</html>