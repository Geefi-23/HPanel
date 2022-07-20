<?php
  require '../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\HabbletDataBase;

  if (!Authenticate::authenticate()) 
	  header('Location: /painel/login');

  $db = HabbletDataBase::getInstance();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS Only -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/colors.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
  <link rel="stylesheet" href="/painel/assets/css/bootstrap.css">

  <title>HPanel | Postar emblema gratuito</title>
</head>
<body>
  <div class="notifications"></div>
  <?php
    require '../../assets/components/loader.php';
    require '../../assets/components/sidebar.php';
  ?>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php' ?>
    <main class="p-3">
      <h4>Postar emblema gratuito</h4>
      <form class="post-form" action="#" name="emblemas">
        <input name="imagem" type="text" placeholder="Link da imagem do emblema" autocomplete="off" />
        <input name="nome" placeholder="Nome do emblema" autocomplete="off" />
        <input name="tutorial" placeholder="Link do tutorial de como obter" autocomplete="off" />
        <div>
          <button type="submit" class="hp-btn-primary">Concluir</button>
        </div>
      </form>
    </main>
  </div>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
  <script src="/painel/assets/js/noticias/postar_emblema_gratis.js" type="module"></script>
</body>
</html>