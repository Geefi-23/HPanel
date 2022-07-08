<?php
  require '../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\HabbletDataBase;

  if (!Authenticate::authenticate()) 
	  header('Location: /painel/login');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
  rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/modal.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
  <link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/painel/assets/css/colors.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  
  <title>HPainel | Gerenciando noticia</title>
</head>
<body>
  <div class="notifications"></div>
  <?php
    require '../../assets/components/sidebar.php';
    require '../../assets/components/loader.php';
  ?>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php' ?>
    <main class="p-3">
    <?php if (!isset($_GET['key'])): ?>
      <h3>NOTICIA INVALIDA!</h3>
    <?php else: ?>
      <?php

        $db = HabbletDataBase::getInstance();

        $sql = 'SELECT * FROM noticias WHERE url = ?';
        $query = $db->prepare($sql);
        $query->bindValue(1, $_GET['key']);
        $query->execute();
        $news = $query->fetch(\PDO::FETCH_ASSOC);
        if (empty($news)):
      ?>
      <h3>Esta noticia não foi encontrada</h3>
      <?php else: ?>
      <form action="#" class="post-form d-flex flex-column gap-3" name="noticia">
        <label>
          <small>Titulo:</small>
          <input style="min-height: 50px;" value="<?php echo $news['titulo'] ?>" name="titulo" />
        </label>
        <label>
          <small>Autor:</small>
          <input style="min-height: 50px;" value="<?php echo $news['criador'] ?>" disabled />
        </label>
        <label>
          <small>Resumo:</small>
          <input style="min-height: 50px;" value="<?php echo $news['resumo'] ?>" name="resumo" />
        </label>
        <label>
          <small>Noticia:</small>
          <div>
            <textarea id="noticiaEdit" name="texto">
              <?php echo $news['texto'] ?>
            </textarea>
          </div>
        </label>
        <div class="d-flex align-items-center w-50 p-2 border rounded" style="min-height: 50px;">
          Status: 
          <input type="radio" name="status" value="ativo" style="display: none"
          <?php echo $news['status'] === 'ativo' ? 'checked' : '' ?>/>
          <input type="radio" name="status" value="inativo" style="display: none"
          <?php echo $news['status'] === 'inativo' ? 'checked' : '' ?>/>
          <div class="ms-2">
            <button id="toggle-status-btn" class="switch-btn <?php echo $news['status'] === 'ativo' ? 'active' : '' ?>" type="button" ></button>
            <span id="status-view" class="ms-2"><?php echo $news['status'] ?></span>
          </div>
        </div>
        <div>
          <a href="#modal-delete-confirmation" class="hp-btn-danger" role="button">Excluir noticia</a>
          <a href="#modal-alter-confirmation" class="hp-btn-primary" role="button">Salvar alterações</a>
        </div>
        <div class="panel-modal-container" id="modal-alter-confirmation">
          <div class="panel-modal" >
            <div class="mb-3">Você tem certeza de que deseja alterar os dados desta noticia?</div>
            <div class="d-flex justify-content-between">
              <a href="#" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="hp-btn-primary">Salvar alterações</button>
            </div>
          </div>
        </div>
        <div class="panel-modal-container" id="modal-delete-confirmation">
          <div class="panel-modal" >
            <div class="mb-3">Você tem certeza de que deseja excluir completamente esta noticia?</div>
            <div class="d-flex justify-content-between">
              <a href="#" class="btn btn-secondary rounded-pill">Cancelar</a>
              <button id="delete-btn" type="button" class="hp-btn-danger">Excluir</button>
            </div>
          </div>
        </div>
      </form>
      <?php endif;?>
    <?php endif;?>
    </main>
  </div>

  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
  <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
  <script>
    let url = '<?php echo $_GET['key']?>';
  </script>
  <script src="/painel/assets/js/noticias/visualizar.js" type="module"></script>
</body>
</html>