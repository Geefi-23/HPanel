<?php
  require __DIR__ . '/vendor/autoload.php';
  
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/modal.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/colors.css">

  <title>HPainel | Minha conta</title>
</head>
<body>
  <div class="notifications"></div>
  <?php
    require 'assets/components/sidebar.php'; 
    require 'assets/components/loader.php'; 
  ?>
  <div style="flex: 1">
    <?php require 'assets/components/header.php' ?>
    <main class="p-5">
      <h4>Minha conta</h4>
      <div class="container">
        <form action="#" class="post-form" name="updateAccount">
          <section>
            <label class="w-100">
              <span>Nome de usuário:</span>
              <input name="nome" type="text" placeholder="" autocomplete="off"/>
            </label>
            <label class="w-100">
              <span>Facebook:</span>
              <input name="facebook" type="text" placeholder="" autocomplete="off"/>
            </label>
            <label class="w-100">
              <span>ID do Discord:</span>
              <input name="discord" type="text" placeholder="" autocomplete="off"/>
            </label>
            <label class="w-100">
              <span>Twitter:</span>
              <input name="twitter" type="text" placeholder="" autocomplete="off"/>
            </label>
          </section>
          <section class="d-flex flex-column gap-2">
            <h5>Troca de senha:</h5>
            
            <label>
              <span>Senha nova:</span>
              <input name="senhaNova" type="password" placeholder="Senha nova" autocomplete="off"/>
            </label>
            <label>
              <span>Repita a senha nova:</span>
              <input name="senhaNovaR" type="password" placeholder="Repita a senha nova" autocomplete="off"/>
            </label>
          </section>
          <div id="salvar-alteracoes" class="hp-modal">
            <div class="d-flex flex-column bg-white rounded p-3 gap-3">
              <small>É necessário confirmar sua senha para prosseguir:</small>
              <label>
                <span>Sua senha:</span>
                <input name="senha" type="password" placeholder="Senha atual" autocomplete="off"/>
              </label>
              <div class="d-flex justify-content-between">
                <a href="#" class="hp-btn-danger rounded-pill" role="button">Cancelar</a>
                <button class="hp-btn-primary" type="submit">Salvar</button>
              </div>
              
            </div>
          </div>
          <div>
            <a href="#salvar-alteracoes" class="btn hp-btn-primary text-decoration-none" role="button">Salvar alterações</a>
          </div>
        </form>
      </div>
    </main>
  </div>

  <script src="/painel/assets/js/minha-conta.js" type="module"></script>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>
</html>