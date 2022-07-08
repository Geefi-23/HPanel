<?php
  require '../../vendor/autoload.php';

  use Utils\Authenticate;

  if (!Authenticate::authenticate()) 
	  header('Location: /painel/login');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/colors.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">

	<title>HPainel | Habblet Mobs/Emblemas</title>
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
			<h4>Postar um comprável</h4>
			<form action="#" method="POST" class="post-form" name="compraveis">
				<input name="nome" class="input" type="text" placeholder="Nome do comprável" autocomplete="off">
			
				<input name="valor" class="input" type="number" step=".01" placeholder="Valor do comprável" autocomplete="off">

				<label style="width: 300px;border-color: #d1d1d1 !important" class="border rounded p-2">
					<span>Tipo de comprável: </span>
					<select name="tipo">
						<option value="" selected disabled>Selecionar</option>
						<option value="mobi">Mobi</option>
						<option value="emblema">Emblema</option>
						<option value="raro">Raro</option>
						<option value="visual">Visual</option>
					</select>
				</label>
				<label>
					<div class="file-input-btn">
						<i class="fa fa-download me-2"></i>
						Escolha a imagem do comprável
					</div>
					<span id="image-name"></span>
					<input name="imagem" type="file" class="d-none" />
				</label>

				<div>
          <button class="hp-btn-primary" type="submit">Enviar</button>
        </div>
			</form>
		</main>
	</div>
	
	<script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
	<script src="/painel/assets/js/compraveis_postar.js" type="module"></script>
</body>
</html>