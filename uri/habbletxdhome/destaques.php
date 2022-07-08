<?php
  require '../../vendor/autoload.php';
  
  use Utils\Authenticate;

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/modal.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/habbletxdhome/destaques.css">

  <title>HPainel | HabbletXD Home</title>
</head>
<body>
  <?php require '../../assets/components/sidebar.php' ?>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php' ?>
    <main class="p-5">
      <h4>Destaques</h4>
      <div class="row">
        <div class="col">
          <h5>Usuários destaque</h5>
          <div id="user-highlights" class="d-flex flex-column align-items-center gap-2">
            <article class="user-card">
              <h6>Geefi</h6>
            </article>
            <article class="user-card"></article>
            <article class="user-card"></article>
          </div>
          <div class="mt-3">
            <form name="userSearchForm" action="#">
              <input name="q" placeholder="Pesquisar" autocomplete="off" />
              <button type="submit">Lupa</button>
            </form>
            <table class="table table-hover border" id="user-search-results" >
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="col">
          <h5>Notícia destaque</h5>
        </div>
      </div>
    </main>
  </div>
  <script src="/painel/assets/js/habbletxdhome/destaques.js" type="module"></script>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>
</html>