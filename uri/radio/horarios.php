<?php
  require '../../vendor/autoload.php';

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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/modal.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">

  <title>HPainel | Horários</title>
</head>
<body>
  <div class="notifications"></div>
  <?php
    require '../../assets/components/loader.php';
    require '../../assets/components/sidebar.php';
  ?>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php' ?>
    <main class="p-5">
      <div class="container">
        <label>
          <span>Data: </span>
          <select id="data" class="border p-1 px-3 rounded"></select>
        </label>
        <table id="table-horarios" class="table table-hover border mt-2">
          <th>ID</th>
          <th>Começa</th>
          <th>Termina</th>
          <th>Locutor</th>
          <th></th>
        </table>
      </div>
    </main>
  </div>

  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
  <script src="/painel/assets/js/radio/horarios.js" type="module"></script>
</body>
</html>