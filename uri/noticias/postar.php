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

  <title>HPanel | Postar noticia</title>
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
      <h4>Postar notícia</h4>
      <form name="noticia" class="post-form">
        <label style="width: 210px">
          <div class="file-input-btn">
            <i class="fa fa-download me-2"></i>
            Escolha uma imagem
          </div>
          <span id="image-name"></span>
          <input name="imagem" type="file" class="d-none" />
        </label>
        <input name="titulo" placeholder="Titulo" aria-placeholder="Titulo" autocomplete="off" />
        <textarea name="resumo" placeholder="Crie um bom resumo para a sua noticia" style="resize: none" aria-placeholder="Resumo"></textarea>
        <div class="d-flex gap-3">
          <label style="width: 200px;border: 1px solid #d1d1d1;" class="rounded p-2">
            <span>Evento:</span>
            <select name="evento">
              <option value="nao" selected>Não</option>
              <option value="sim">Sim</option>
            </select>
          </label>
          <label style="width: 200px;border: 1px solid #d1d1d1;" class="rounded p-2">
            <span>Escolha uma categoria:</span>
            <select name="categoria">
              <?php
                $sql = 'SELECT id, nome FROM noticias_cat';
                $query = $db->prepare($sql);
                $query->execute();

                foreach($query->fetchAll() as $category) {
                  echo "<option value=\"{$category['id']}\">{$category['nome']}</option>";
                }
              ?>
            </select>
          </label>
        </div>
        <textarea id="noticiaWriter"></textarea> 
        <div>
          <button class="hp-btn-primary" type="submit">Enviar</button>
        </div>
      </form>
    </main>
  </div>
 
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
  <script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
  <script src="/painel/assets/js/noticias/postar.js" type="module"></script>
</body>
</html>