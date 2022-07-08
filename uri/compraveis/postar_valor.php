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

	<title>HPainel | Valor</title>
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
			<h4>Postar valor</h4>
			<form action="#" method="POST" class="post-form" name="valores">
				<input name="nome" class="input" type="text" placeholder="Nome do valor" autocomplete="off">
				<input name="preco" class="input" type="number" step=".01" placeholder="Preço na loja" autocomplete="off">
				<input name="valorltd" class="input" type="number" step=".01" placeholder="Valor em LTD" autocomplete="off">

				<label class="border rounded p-2">
					<span>Situação:</span>
					<select name="situacao">
						<option value="Em alta">Em alta</option>
						<option value="Estável">Estável</option>
						<option value="Baixa">Baixa</option>
					</select>
				</label>

				<label class="border rounded p-2">
					<span>Moeda do raro:</span>
					<select name="moeda">
						<option value="diamante">Diamantes</option>
						<option value="asinha">Asinhas</option>
					</select>
				</label>
				<label style="width: 300px;border-color: #d1d1d1 !important" class="border rounded p-2">
					<span>Categoria:</span>
					<select name="categoria">
						<?php
							$sql = "SELECT * FROM valores_cat";
							$query = $db->prepare($sql);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_ASSOC);

							foreach($results as $categoria):
						?>
							<option value="<?php echo $categoria['id'] ?>">
								<?php echo $categoria['nome'] ?>
							</option>
						<?php endforeach; ?>
					</select>
				</label>
				<label id="uploadimage-wrapper" class="mt-3">
					<div class="file-input-btn">
						<i class="fa fa-download me-2"></i>
						Escolha a imagem
					</div>
					<span id="image-name"></span>
					<input name="imagem" type="file" class="d-none" />
				</label>
				<input name="urlimagem" class="d-none" type="text" placeholder="Insira a url da imagem" autocomplete="off"/>
				<div>
          <button class="hp-btn-primary" type="submit">Enviar</button>
        </div>
			</form>
		</main>
	</div>
	
	<script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
	<script src="/painel/assets/js/compraveis/postar_valor.js" type="module"></script>
</body>
</html>