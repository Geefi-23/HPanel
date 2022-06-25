<?php
  require '../../assets/backend/Authenticate.php';

	if (!authenticate()) 
		header('Location: /painel/login');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
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
	<main class="p-3">
		<form action="#" method="POST" class="post-form" name="compraveis">
			<input name="nome" class="input" type="text" placeholder="Nome do comprável" autocomplete="off">
		
			<input name="valor" class="input" type="number" step=".01" placeholder="Valor do comprável" autocomplete="off">

			<label style="width: 300px;border-color: #d1d1d1 !important" class="border rounded p-2">
				<span>Tipo de comprável: </span>
				<select name="tipo">
					<option value="" selected disabled>Selecionar</option>
					<option value="mobi">Mobis</option>
					<option value="emblema">Emblema</option>
					<option value="raro">Raro</option>
					<option value="visual">Emblema</option>
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

			<button class="submit" type="submit">Enviar</button>
		</form>
	</main>
	<script src="/painel/assets/js/compraveis_postar.js" type="module"></script>
</body>
</html>