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
  <div class="notifications"></div>
  <?php 
    require '../../assets/components/sidebar.php';
    require '../../assets/components/loader.php'
  ?>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php' ?>
    <main class="p-5">
      <h4>Destaques</h4>
      <div class="row">
        <div class="col">
          <h5>Usuários destaque</h5>
          <div id="user-highlights" class="d-flex flex-column align-items-center gap-2">
            <a class="hp-btn-success" href="#modal-searchuser" role="button">Adicionar usuário destaque</a>
          </div>
          
          <div id="modal-searchuser" class="hp-modal">
            <section class="bg-white p-3 rounded">
              <div class="d-flex justify-content-end">
                <a href="#" class="bg-transparent border-0" role="#">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              </div>
              <form name="userSearchForm" class="post-form flex-row gap-0" action="#">
                <input class="rounded-0 rounded-start" name="q" placeholder="Pesquisar" autocomplete="off" />
                <button type="submit" class="hp-bg-blue px-3 text-white border-0 rounded-end">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </form>

              <table class="table table-hover border mt-2" id="user-search-results" >
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

              <form name="setHighlightForm" action="#" class="post-form d-none">
                <h5>Adicionando como destaque:</h5>
                <input name="user" autocomplete="off" readonly placeholder="Usuario" />
                <textarea name="reason" id="" cols="30" rows="7" placeholder="Por que este usuário é um destaque?"></textarea>
                <div>
                  <button type="submit" class="hp-btn-primary">Concluir</button>
                </div>
              </form>
            </section>
          </div>
        </div>
        <div class="col">
          <h5>Notícia destaque</h5>
          <a class="hp-btn-success" href="#modal-newshighlight" role="button">Setar notícia destaque</a>

          <section id="modal-newshighlight" class="hp-modal">
            <div class="bg-white p-3">
              <h5>Setar noticia destaque</h5>
              <form name="searchnews" class="post-form flex-row gap-0" action="#">
                
                <input class="rounded-0 rounded-start" name="q" placeholder="Pesquisar titulo" autocomplete="off" />
                <button type="submit" class="hp-bg-blue px-3 text-white border-0 rounded-end">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </form>
              <table class="table table-hover border mt-2" id="news-search-results" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Resumo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
              <a href="#" class="hp-btn-danger" role="button">Cancelar</a>
            </div>
          </section>

          <div id="news-highlight" class="pt-3"></div>
        </div>
      </div>
      <div class="mt-3">
        <h5>Carrossel</h5>
        <div id="lista-carousel"></div>
        <a href="#modal-carousel">Adicionar nova imagem ao carrossel</a>
        <section id="modal-carousel" class="hp-modal">
          <div>
            <form name="saveCarousel" class="post-form bg-white p-3 rounded" action="#">
              
              <label class="border border-secondary rounded p-2" style="border-style:dashed !important">
                <span>Clique aqui para escolher a imagem</span>
                <input name="imagem" type="file" style="display: none"/>
              </label>
              <input name="destino" placeholder="Link de destino" autocomplete="off" />
              <div class="d-flex justify-content-between">
                <button class="hp-btn-danger" type="reset" onclick="location.href = '#'">Cancelar</button>
                <button class="hp-btn-primary" type="submit">Salvar</button>
              </div>
            </form>
          </div>
        </section>
      </div>
      
    </main>
  </div>
  
  <script src="/painel/assets/js/habbletxdhome/destaques.js" type="module"></script>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>
</html>