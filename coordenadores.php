<?php
  require './assets/backend/Token.php';
  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
    header('Location: /painel/login');
?>

<!DOCTYPE html>
<!-- 
    PROGRAMADOR DO FUTURO, ENTENDA OQ ACONTECEU AQ. 

    NÃO FOMOS PAGOS PRA FAZER ESSE PAINEL, E AINDA POR CIMA NOS DERAM UM PRAZO CURTO.
    POR CONTA DOS "COMPRADORES" FICAREM PERGUNTANDO "ta pronto" PRA GENTE À CADA 5 MINUTOS,
    PASSAMOS A FAZER TUDO DE QUALQUER JEITO PARA SERMOS RAPÍDOS E ACABAR COM O NOSSO SOFRIMENTO.

    VARIAS FUNÇÕES PROVAVELMENTE FUNCIONAM, MAS ESTÃO BAGUNÇADAS. A MAIORIA NÃO FOI NEM IMPLEMENTADA 

    SE VOCÊ ESTÁ EDITANDO ISSO DE BOM CORAÇÃO, ACREDITE: METE O PÉ KSKSKSKSKSKS.
    SE VOCÊ ESTÁ SENDO PAGO, MEUS PARABÉNS E BOA SORTE!

    DEIXEI ALGUNS COMENTÁRIOS ESPALHADOS PELO CÓDIGO PARA AJUDAR A ENTENDER O QUE ESTÁ ACONTECENDO (OU O QUE DEVERIA ACONTECER).
-->

<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HPainel | Coordenadores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- BOOTSTRAP 4 POR MOTIVO DESCONHECIDO. ATUALIZE ASSIM QUE POSSIVEL -->
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/team_members.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>
  <?php require 'assets/components/sidebar.php'; ?>
  <main>
    <div class="d-flex justify-content-around w-100 py-2">
      <button id="btn-register" class="btn btn-success">Cadastrar</button>
      <div class="manage-selected invisible">
        <button id="btn-delete" class="btn btn-danger">Deletar</button>
        <button id="btn-edit" class="btn btn-primary">Editar</button>
      </div>
    </div>
    <table id="member-table" class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nick</th>
          <th scope="col">Último Acesso</th>
          <th scope="col">Cargo</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </main>
  <script src="assets/js/team_members.js" type="module"></script>
</body>

</html>