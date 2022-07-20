<?php
  require '../../vendor/autoload.php';

  use Utils\Authenticate;
	use Utils\HabbletDataBase;

  if (!Authenticate::authenticate()) 
	  header('Location: /painel/login');

	$db = HabbletDataBase::getInstance();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/colors.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
	<link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/painel/assets/css/compraveis/gerenciar.css">

	<title>HPainel | Gerenciar compraveis</title>
</head>
<body>
  <div class="notifications"></div>
	<?php
    require '../../assets/components/sidebar.php';
		require '../../assets/components/loader.php';
  ?>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php' ?>
    <main class="p-5">
      <h4>Gerenciar valores</h4>
      <div id="lista"></div>
    </main>
  </div>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
	<script src="/painel/assets/js/compraveis/gerenciar_valores.js" type="module"></script>
</body>
</html>