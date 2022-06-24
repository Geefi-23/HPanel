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

  <!-- CSS Only -->
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

  <title>HPanel | Postar noticia</title>
</head>
<body>
  <div class="notifications"></div>
  <?php
    require '../../assets/components/loader.php';
    require '../../assets/components/sidebar.php';
  ?>
  <main class="p-3">
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
      <label style="width: 200px;border-color: #d1d1d1 !important" class="border rounded p-2">
        <span>Escolha uma categoria: </span>
        <select name="categoria">
          <?php
            require '../../assets/backend/HabbletDataBase.php';

            $db = HabbletDataBase::getInstance();

            $sql = 'SELECT id, nome FROM noticias_cat';
            $query = $db->prepare($sql);
            $query->execute();

            foreach($query->fetchAll() as $category) {
              echo "<option value=\"{$category['id']}\">{$category['nome']}</option>";
            }
          ?>
        </select>
      </label>
      <textarea id="noticiaWriter"></textarea> 
      <button class="submit" type="submit">Enviar</button>
    </form>
  </main>
  <script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
  <script src="/painel/assets/js/noticias_postar.js" type="module"></script>
</body>
</html>