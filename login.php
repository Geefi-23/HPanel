<?php
    require './assets/backend/Token.php';
    if (isset($_COOKIE['jwt']) && Token::isValid($_COOKIE['jwt'])) 
      header('Location: /');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="login-page">
    <div class="form">
      <form class="register-form" action="#">
        <input type="text" placeholder="name"/>
        <input type="password" placeholder="password"/>
        <input type="text" placeholder="email address"/>
        <button>create</button>
        <p class="message">Already registered? <a href="#">Sign In</a></p>
      </form>
      <form id="form-login" class="login-form">
        <input id="in-username" type="text" placeholder="username"/>
        <input id="in-password" type="password" placeholder="password"/>
        <button type="reset">LIMPAR</button>
        <button type="submit">login</button>
        <p class="message">Deseja criar sua conta ? <a href="cadastro.html">Clique aqui</a></p>
      </form>
    </div>
  </div>
  <div class="footer">
    <footer>
      <h1>Hpainel-2022 - Todos direitos reservados. Desenvolvido por Marcos e Geefi.</h1>
    </footer>
  </div>
  <script src="/assets/js/login.js" type="module"></script>
</body>
</html>