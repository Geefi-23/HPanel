<?php
  require '../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\DataBase;

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

  <title>HPanel | Adicionar membro na equipe</title>
</head>
<body>
  <?php
    require '../../assets/components/sidebar.php'; 
    require '../../assets/components/loader.php'; 
  ?>
  <div class="notifications"></div>
  <div style="flex: 1">
    <?php require '../../assets/components/header.php' ?>
    <main class="p-5">
      <div class="container">
        <h4>Cargos</h4>
        <div id="modal-novocargo" class="hp-modal">
          <form name="novocargo" class="post-form bg-white rounded p-3">
            <h4>Criar novo cargo</h4>
            <input name="nome" placeholder="Nome do cargo" autocomplete="off" />
            <label class="d-flex flex-column gap-2 p-2 border rounded">
              <span>Permissões:</span>
              <ul id="permission-list">

              </ul>
              <select name="permissao" class="border border-secondary rounded"></select>
              <div class="d-flex justify-content-end">
                <button id="add-permission" class="btn btn-primary" type="button">Adicionar permissão</button>
              </div>
            </label>
            <div class="d-flex justify-content-between">
              <a href="#" role="button" class="hp-btn-danger">Cancelar</a>
              <button type="submit" class="hp-btn-primary">Salvar</button>
            </div>
          </form>
        </div>
        <div id="modal-editarcargo" class="hp-modal">
          <form name="editarcargo" class="post-form bg-white rounded p-3">
            <h4>Editando cargo</h4>
            <input name="nome" placeholder="Nome do cargo" autocomplete="off" />
            <div class="d-flex flex-column gap-2 p-2 border rounded">
              <span>Permissões:</span>
              <ul id="permission-list" class="d-flex flex-column gap-1 list-unstyled bg-secondary p-2 text-white rounded">

              </ul>
              <select name="permissao" class="border border-secondary rounded"></select>
              <div class="d-flex justify-content-end">
                <button id="add-permission-formedit" class="btn btn-primary" type="button">Adicionar permissão</button>
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <a href="#" role="button" class="hp-btn-danger">Cancelar</a>
              <button type="submit" class="hp-btn-primary">Salvar</button>
            </div>
          </form>
        </div>
        <a 
          href="#modal-novocargo"
          class="btn text-white" 
          style="background-color: #054468;" 
          role="button"
        >Novo cargo</a>
        <a 
          href="#modal-novapermissao"
          class="btn text-white" 
          style="background-color: #054468;" 
          role="button"
        >Nova permissão</a>

        <table id="cargos-table" class="table table-hover border mt-1">
          <th>ID</th>
          <th>Nome</th>
          <th>Permissões</th>
        </table>
      </div>
    </main>
  </div>
  
  <script src="https://kit.fontawesome.com/83b300201b.js" crossorigin="anonymous"></script>
  <script src="/painel/assets/js/coordenadores/cargos.js" type="module"></script>
</body>
</html>