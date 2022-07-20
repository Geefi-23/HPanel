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

  <!-- CSS Only -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/manage-news.css">

  <title>HPainel | Gerenciar notícias</title>
</head>
<body>
  <div class="notifications"></div>
  <?php
    require '../../assets/components/sidebar.php';
    require '../../assets/components/loader.php';
  ?>
  <main>
    <h4>Gerenciar noticias</h4>
    <div class='d-flex gap-3 flex-column p-3' id="noticias"></div>
    <nav class="d-flex justify-content-evenly w-25 pb-5" >
      <a href="/painel/noticias/gerenciar?page=<?php echo ((int)$_GET['page'] - 1) ?>">Anterior</a>
      <a href="/painel/noticias/gerenciar?page=<?php echo ((int)$_GET['page'] + 1) ?>">Proximo</a>
    </nav>
  </main>
  
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
  <script src="/painel/assets/js/noticias/gerenciar.js" type="module"></script>
</body>
</html>