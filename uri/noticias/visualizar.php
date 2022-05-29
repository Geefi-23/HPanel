<?php
  require '../../assets/backend/Token.php';
  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
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
  <!-- CSS only -->
  <title>Gerenciando noticia</title>
</head>
<body>
  <div class="notifications"></div>
  <?php
    require '../../assets/components/sidebar.php';
  ?>
  <main class="p-3">
  <?php if (!isset($_GET['key'])): ?>
    <h3>NOTICIA INVALIDA!</h3>
  <?php else: ?>
    <?php
      require '../../assets/backend/HabbletDataBase.php';

      $db = HabbletDataBase::getInstance();

      $sql = 'SELECT * FROM noticias WHERE url = ?';
      $query = $db->prepare($sql);
      $query->bindValue(1, $_GET['key']);
      $query->execute();
      $news = $query->fetch(PDO::FETCH_ASSOC);
      if (empty($news)):
    ?>
    <h3>Esta noticia não foi encontrada</h3>
    <?php else: ?>
    <form action="#" class="d-flex flex-column gap-3" name="noticia">
      <label>
        <small>Titulo:</small>
        <input class="d-flex align-items-center p-2 border rounded w-50" 
        style="min-height: 50px;" value="<?php echo $news['titulo'] ?>" name="titulo" />
      </label>
      <label>
        <small>Autor:</small>
        <input class="d-flex align-items-center p-2 border rounded w-50" 
        style="min-height: 50px;" value="<?php echo $news['criador'] ?>" disabled />
      </label>
      <label>
        <small>Resumo:</small>
        <input class="d-flex align-items-center p-2 border rounded w-50" 
        style="min-height: 50px;" value="<?php echo $news['resumo'] ?>" name="resumo" />
      </label>
      <label>
        <small>Noticia:</small>
        <div class="w-50">
          <textarea id="noticiaEdit" name="texto">
            <?php echo $news['texto'] ?>
          </textarea>
        </div>
      </label>
      <div class="d-flex align-items-center w-50 p-2 border rounded" style="min-height: 50px;">
        Status: 
        <label class="ms-3">
          <span>Ativo</span>
          <input type="radio" name="status" value="ativo"
          <?php echo $news['status'] == 'ativo' ? 'checked' : '' ?> />
        </label>
        <label class="ms-3">
          <span>Inativo</span>
          <input type="radio" name="status" value="inativo"
          <?php echo $news['status'] == 'inativo' ? 'checked' : '' ?> />
        </label>
      </div>
      <div>
        <a href="#modal-delete-confirmation" class="btn btn-danger">Excluir noticia</a>
        <a href="#modal-alter-confirmation" class="btn btn-primary">Salvar alterações</a>
      </div>
      <div class="panel-modal-container" id="modal-alter-confirmation">
        <div class="panel-modal" >
          <div class="mb-3">Você tem certeza de que deseja alterar os dados desta noticia?</div>
          <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
          </div>
        </div>
      </div>
      <div class="panel-modal-container" id="modal-delete-confirmation">
        <div class="panel-modal" >
          <div class="mb-3">Você tem certeza de que deseja excluir completamente esta noticia?</div>
          <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-secondary">Cancelar</a>
            <button id="delete-btn" class="btn btn-primary">Excluir</button>
          </div>
        </div>
      </div>
    </form>
    <?php endif;?>
  <?php endif;?>
  </main>
  <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
  <script>
    let url = '<?php echo $_GET['key']?>';
  </script>
  <script src="../../assets/js/news-manager-viewer.js" type="module"></script>
</body>
</html>