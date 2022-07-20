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
      <h4>Gerenciar compráveis</h4>
      <form action="#" class="post-form" name="update_buyable">
        <?php
          $id = (int) $_GET['id'];
          $sql = "SELECT nome, valor, tipo, gratis FROM compraveis WHERE id = ?";
          $query = $db->prepare($sql);
          $query->bindValue(1, $id, PDO::PARAM_INT);
          $query->execute();
          
          $compravel = $query->fetch(PDO::FETCH_ASSOC);

          if (!$compravel):
        ?>
        <h4 class="text-center">404 - Esse comprável não existe</h4>
        <?php else: ?>
        <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
        <input name="nome" autocomplete="off" placeholder="Nome do comprável" value="<?php echo $compravel['nome'] ?>" />
        <input name="valor" type="number" autocomplete="off" placeholder="Valor do comprável" value="<?php echo $compravel['valor'] ?>" />
        <label style="width: 300px;border-color: #d1d1d1 !important" class="border rounded p-2">
					<span>Tipo de comprável: </span>
					<select name="tipo">
						<option <?php echo $compravel['tipo'] == 'mobi' ? 'selected' : '' ?> value="mobi">Mobi</option>
						<option <?php echo $compravel['tipo'] == 'emblema' ? 'selected' : '' ?> value="emblema">Emblema</option>
						<option <?php echo $compravel['tipo'] == 'raro' ? 'selected' : '' ?> value="raro">Raro</option>
						<option <?php echo $compravel['tipo'] == 'visual' ? 'selected' : '' ?> value="visual">Visual</option>
					</select>
				</label>
        <div class="d-flex align-items-center w-50 p-2 border rounded" style="min-height: 50px;">
          Gratis: 
          <input type="radio" name="gratis" value="sim" style="display: none"
          <?php echo $compravel['gratis'] === 'sim' ? 'checked' : '' ?>/>
          <input type="radio" name="gratis" value="nao" style="display: none"
          <?php echo $compravel['gratis'] === 'nao' ? 'checked' : '' ?>/>
          <div class="ms-2">
            <button id="toggle-status-btn" class="switch-btn <?php echo $compravel['gratis'] === 'sim' ? 'active' : '' ?>" type="button" ></button>
            <span id="status-view" class="ms-2"><?php echo $compravel['gratis'] ?></span>
          </div>
        </div>
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
            <p>Tem certeza de que deseja excluir permanentemente esse comprável?</p>
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
	<script src="/painel/assets/js/compraveis/gerenciando.js" type="module"></script>
</body>
</html>