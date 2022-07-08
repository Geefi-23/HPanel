<?php
  require __DIR__ . '/vendor/autoload.php';
  
  use Utils\Authenticate;

  if (!Authenticate::authenticate()) 
	  header('Location: /painel/login');
?>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/colors.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/index.css">

  <title>HPainel | Inicio</title>
</head>

<body>
  <a href="https://icons8.com/icon/o7eir7CYJkqm/mulher-popular"></a>
  <?php require 'assets/components/sidebar.php' ?>
  <div style="flex: 1">
    <?php require 'assets/components/header.php' ?>
    <main>
      <div class="dashboard">
        <div class="section-card section-card--darkBlue">
          <div class="section-card__icon">
            <i class="fa fa-users" aria-hidden="true"></i>
          </div>
          <div class="section-card__details">
            <h5>Usuarios</h5>
            <span id="users-count"></span>
          </div>
          <button class="section-card__see-more-btn">Saiba mais</button>
        </div>
        <div class="section-card section-card--green">
          <div class="section-card__icon">
            <i class="fa fa-money" aria-hidden="true"></i>
          </div>
          <div class="section-card__details">
            <h5>Minha conta</h5>
          </div>
          <a href="conta" class="section-card__see-more-btn text-white">Saiba mais</a>
        </div>
        <div class="section-card section-card--orange badge-soon">
          <div class="section-card__icon">
            <i class="fa fa-bell" aria-hidden="true"></i>
          </div>
          <div class="section-card__details">
            <h5>Avisos</h5> 
            <span>10</span>
          </div>
          <button class="section-card__see-more-btn">Saiba mais</button>
        </div>
        <div class="section-card section-card--blue badge-soon">
          <div class="section-card__icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="section-card__details">
            <h5>Emblemas novos</h5>
            <span>10</span>
          </div>
          <button class="section-card__see-more-btn">Saiba mais</button>
        </div>
        <div class="section-card section-card--red badge-soon">
          <div class="section-card__icon">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </div>
          <div class="section-card__details">
            <h5>Novas vinhetas</h5> 
            <span>10</span>
          </div>
          <button class="section-card__see-more-btn">Saiba mais</button>
        </div>
        <div class="section-card section-card--purple">
          <div class="section-card__icon">
            <i class="fa fa-comments" aria-hidden="true"></i>
          </div>
          <div class="section-card__details">
            <h5>Locutores da Semana</h5>
            <span id="announcers-count"></span>
          </div>
          <button class="section-card__see-more-btn">Saiba mais</button>
        </div>
      </div>
    </main>
  </div>
  <script src="./assets/js/index.js" type="module"></script>
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
</body>
</html>