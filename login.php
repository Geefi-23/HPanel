<?php
  require './assets/backend/Token.php';
  if (isset($_COOKIE['hp_pages_auth']) && Token::isValid($_COOKIE['hp_pages_auth'])) 
    header('Location: /painel/');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/notifications.css">
  <title>HPainel | Login</title>
</head>
<body>
  <div class="notifications">
  </div>
  <div class="form-container">
    <form id="form-login" class="d-flex flex-column">
      <h2 class="text-center">HPanel - Painel Administrativo</h2>
      <h4 class="text-center" style="font-weight: 400">Bem vindo ao nosso painel administrativo!<br>Faça login para continuar:</h4>
      <div class="d-flex flex-column align-items-center gap-3 mt-5">
        <input id="in-username" class="login-input" type="text" placeholder="Usuario" autocomplete="off"/>
        <div class="position-relative">
          <input id="in-password" class="login-input" type="password" placeholder="Senha" autocomplete="off"/>
          <button id="pass-visib-toggle" 
          class="position-absolute h-100 bg-transparent border-0" style="right: 1rem;"
          type="button">
            <i class="fas fa-eye"></i>
          </button>
        </div>
        
      </div>
      <div class="d-flex justify-content-between m-auto mt-3" style="width: 450px">
        <button class="btn-reset" type="reset">Limpar</button>
        <button class="btn-submit" type="submit">Entrar</button>
      </div>
      <small class="mt-5 text-center">Copyright © HPanel - Todos os direitos reservados.</small>
    </form>
  </div>
  <script src="./assets/js/login.js" type="module"></script>
</body>
</html>