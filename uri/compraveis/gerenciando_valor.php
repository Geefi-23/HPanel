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
  <link rel="stylesheet" href="/painel/assets/css/modal.css">
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
      <form action="#" class="post-form" name="update_buyable">
        <?php
          $id = (int) $_GET['id'];

          $sql = "SELECT id, nome FROM valores_cat";
          $query = $db->prepare($sql);
          $query->execute();
          $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

          $sql = "SELECT v.nome, v.preco, v.valorltd, v.situacao, v.moeda, v.categoria AS `categoria_id`, v.icone
          FROM valores AS v
          WHERE v.id = ?";
          $query = $db->prepare($sql);
          $query->bindValue(1, $id, PDO::PARAM_INT);
          $query->execute();
          
          $valor = $query->fetch(PDO::FETCH_ASSOC);

          if (!$valor):
        ?>
        <h4 class="text-center">404 - Esse valor não existe</h4>
        <?php else: ?>

        <div>
          <span>Ícone:</span>
          <label 
            class="image-input<?php echo $valor['icone'] !== '' ? ' filled' : '' ?>" 
            style="background: url('<?php echo $valor['icone'] ?>') center center no-repeat"
          ></label>
        </div>
        <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
        <input name="icone" type="text" placeholder="Icone do valor" autocomplete="off" 
        value="<?php echo $valor['icone'] ?>" />
        <input name="emblema" type="text" placeholder="Link do emblema" autocomplete="off" 
        value="<?php $valor['categoria_id'] == '3' && print($valor['emblema']) ?>" 
        class="<?php $valor['categoria_id'] != '3' && print('d-none') ?>" />
        <input name="nome" autocomplete="off" placeholder="Nome do valor" 
        value="<?php echo $valor['nome'] ?>" />
        <input name="preco" type="number" autocomplete="off" placeholder="Preço do valor" 
        value="<?php echo $valor['preco'] ?>" />
        <input name="valorltd" type="number" autocomplete="off" placeholder="Valor em LTD" 
        value="<?php echo $valor['valorltd'] ?>" />
        
        <label class="border rounded p-2">
					<span>Moeda do raro:</span>
					<select name="moeda">
						<option value="diamante" <?php echo $valor['moeda'] === 'diamante' ? 'selected' : '' ?>>Diamantes</option>
						<option value="asinha" <?php echo $valor['moeda'] === 'asinha' ? 'selected' : '' ?>>Asinhas</option>
					</select>
				</label>

        <label class="border rounded p-2">
					<span>Situação:</span>
					<select name="situacao">
						<option value="Em alta" <?php echo $valor['situacao'] === 'Em alta' ? 'selected' : '' ?>>Em alta</option>
						<option value="Estável" <?php echo $valor['situacao'] === 'Estável' ? 'selected' : '' ?>>Estável</option>
						<option value="Baixa" <?php echo $valor['situacao'] === 'Baixa' ? 'selected' : '' ?>>Baixa</option>
					</select>
				</label>

        <label style="width: 300px;border-color: #d1d1d1 !important" class="border rounded p-2">
					<span>Categoria do valor: </span>
					<select name="categoria">
            <?php foreach($categorias as $categoria): ?>
						<option value="<?php echo $categoria['id'] ?>" 
            <?php echo $valor['categoria_id'] === $categoria['id'] ? 'selected' : '' ?>>
              <?php echo $categoria['nome'] ?>
            </option>
            <?php endforeach;?>
					</select>
				</label>
        
        <div class="d-flex justify-content-between">
          <a href="#modal-delete" class="hp-btn-danger" role="button">Excluir</a>

          <a href="#modal-saveupdates" class="hp-btn-primary" role="button">
            Salvar alterações
          </a>
        </div>

        <section id="modal-saveupdates" class="hp-modal">
          <div class="bg-white p-3 rounded">
            <p>Tem certeza de que deseja salvar essas alterações?</p>
            <div class="d-flex justify-content-between">
              <a href="#" class="hp-btn-danger" role="button">Cancelar</a>
              <button type="submit" class="hp-btn-primary">Sim</button>
            </div>
          </div>
        </section>

        <section id="modal-delete" class="hp-modal">
          <div class="bg-white p-3 rounded">
            <p>Tem certeza de que deseja excluir permanentemente esse valor?</p>
            <div class="d-flex justify-content-between">
              <a href="#" class="hp-btn-danger" role="button">Cancelar</a>
              <button id="delete-btn" type="button" class="hp-btn-primary">Sim</button>
            </div>
          </div>
        </section>
        <?php endif;?>
      </form>
    </main>
  </div>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
	<script src="/painel/assets/js/compraveis/gerenciando_valor.js" type="module"></script>
</body>
</html>