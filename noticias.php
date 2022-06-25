<?php
  require 'assets/backend/Authenticate.php';

  if (!authenticate()) 
	  header('Location: /painel/login');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="assets/lib/editor/editor.js"></script>
  <link rel="stylesheet" href="assets/lib/editor/editor.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/functional-card.css">

  <title>Noticias</title>
</head>
<body>
  <?php
    require 'assets/components/sidebar.php';
  ?>
  <main>
    <div class="dashboard">
      <a href="noticias/postar" class="functional-card">
        <h4>Postar Noticia</h4>
        <p>Use esta área para postagem de notícias.</p>
      </a>
      <a href="evento/postar" class="functional-card">
        <h4>Postar Evento</h4>
        <p>Use esta área para postagem de eventos.</p>
      </a>
      <a href="noticias/comentarios" class="functional-card">
        <h4>Gerenciar comentários</h4>
        <p>Área destinada ao gerenciamento geral de todos os comentarios em qualquer tópico ou post.</p>
      </a>
      <a href="noticias/gerenciar" class="functional-card">
        <h4>Gerenciar notícias</h4>
        <p>Área destinada ao gerenciamento geral de todos as notícias da plataforma.</p>
      </a>
    </div>
    
  </main>
    <!--<h2 class="demo-text">Postagem De Noticias </h2>
      
      <div class="container">
        <div class="row">
          <div class="col-lg-12 nopadding">
            <input type="text" style="width: 700px;height:40px;border:1px solid #dee2e6;padding-left: 10px" placeholder="Título da notícia">
            <textarea id="txtEditor"></textarea> 
          </div>
        </div>
      </div> -->
  
</body>
</html>