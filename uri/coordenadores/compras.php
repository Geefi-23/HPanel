<?php
  require '../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\DataBase;

  if (!Authenticate::authenticate()) 
	  header('Location: /painel/login');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="/painel/assets/css/colors.css">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
  <link rel="stylesheet" href="/painel/assets/css/modal.css">

  <title>HPainel | Compras</title>
</head>
<body>
  <div class="notifications"></div>
  <?php 
    require '../../assets/components/sidebar.php';
    require '../../assets/components/loader.php';
  ?>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php'; ?>
    <main class="p-5">
      <h4>Compras</h4>
      <p>Aqui você pode gerenciar todas as compras feitas na HabbletXD!</p>
      <table id="compras" class="table table-hover border">
        <thead>
          <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Discord do comprador</th>
            <th>Código de compra</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </main>
  </div>
  <script src="/painel/assets/js/coordenadores/compras.js" type="module"></script>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>
</html>