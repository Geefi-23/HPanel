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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/loader.css">
  <link rel="stylesheet" href="/painel/assets/css/modal.css">

  <title>HPanel | Gerenciar coordenadores</title>
</head>
<body>
  <?php 
  require '../../assets/components/sidebar.php'; 
  require '../../assets/components/loader.php'; 
  require '../../assets/backend/DataBase.php';

  $db = DataBase::getInstance();

  $sql = "SELECT * FROM hp_cargos WHERE nome != 'DIRETOR'";
  $query = $db->prepare($sql);
  $query->execute();

  $cargos = $query->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <div class="notifications"></div>
  <main class="p-5">
    <div class="container">
      <div id="modal-adicionarmembro" class="hp-modal">
        <form name="addMember" class="post-form bg-white p-3 rounded">
          <input name="nome" placeholder="Nome" autocomplete="off"/>
          <h4>Adicionar membro</h4>
          <input name="senha" type="password" placeholder="Senha" autocomplete="off"/>
          <select name="cargo" class="border rounded">
            <?php foreach ($cargos as $cargo): ?>
              <option value="<?php echo $cargo['id'] ?>"><?php echo $cargo['nome'] ?></option>
            <?php endforeach; ?>
          </select>
          <div class="d-flex justify-content-between">
            <a href="#" role="button" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
      <a href="#modal-adicionarmembro" class="btn b-0" style="background-color: #054468; color: white" role="button">
        <i class="fas fa-plus me-1"></i>
        Adicionar membro
      </a>
      <div id="modal-editarmembro" class="hp-modal">
        <form name="editMember" class="post-form bg-white p-3 rounded">
          <h4>Editar membro</h4>
          <input name="nome" placeholder="Nome" autocomplete="off"/>
          <select name="cargo" class="border rounded">
            <?php foreach ($cargos as $cargo): ?>
              <option value="<?php echo $cargo['id'] ?>"><?php echo $cargo['nome'] ?></option>
            <?php endforeach; ?>
          </select>
          <div class="d-flex justify-content-between">
            <a href="#" role="button" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
      <table class="table table-hover border mt-1" id="members-table">
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Ultimo login</th>
          <th>Ultimo ip</th>
          <th>Cargo</th>
        </tr>
      </table>
    </div>
  </main>
  <script src="/painel/assets/js/coordenadores/gerenciar.js" type="module"></script>
</body>
</html>