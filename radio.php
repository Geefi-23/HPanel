<?php
  require './assets/backend/Token.php';
  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
    header('Location: /painel/login');
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS ONLY -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="assets/css/colors.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/functional-card.css">

  <title>Rádio</title>
</head>
<body>
  <?php
    require 'assets/components/sidebar.php';
  ?>
  <main>
    <div class="dashboard">
      <div class="functional-card--static">
        <h4>Dados</h4>
        <span>Forneça-os em seu Sam Broadcaster ou no programa usado para locução.</span><br><br>
        <span><strong>Quality:</strong> High Quality</span><br>
        <span><strong>Format:</strong> MP3(PRO): 64 kb/s, 44.1 kHz, Stereo</span><br>
        <span><strong>Ip:</strong> 192.95.30.147</span><br>
        <span><strong>Porta:</strong> 4724</span><br>
        <span><strong>Senha do rádio:</strong> DDKHDGFCDHB</span><br>
        <span><strong>Station name:</strong> ingridwillians</span><br>
        <span><strong>Genre:</strong> Seu programa</span><br>
        <span><strong>WebSite URL:</strong> <a href="http://habbletxd.com.br/">http://habbletxd.com.br/</a></span><br>
      </div>
      <div class="functional-card">
        <h4>Pedidos</h4>
        <span>Tabela de pedidos enviados ao locutor pelos seus ouvintes.</span>
      </div>
      <div class="functional-card">
        <h4>Vinhetas</h4>
        <span>Vinhetas disponíveis para uso do locutor.</span>
      </div>
      <div class="functional-card">
        <h4>Horários</h4>
        <span>Tabela de horários marcados para a entrada de locutores.</span>
      </div>
      <div class="functional-card">
        <h4>Marcar Horário</h4>
        <span>Locutor, marque seu horário aqui!</span>
      </div>
    </div>
    </div>
  </main>
</body>
</html>