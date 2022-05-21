

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
  rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <!-- CSS only -->
  <title>Gerenciando noticia</title>
</head>
<body>
  <?php
    require '../../assets/components/sidebar.php';
  ?>
  
  <main class="p-3">
  <?php if (!isset($_GET['key'])): ?>
    <h3>NOTICIA INVALIDA!</h3>
  <?php else: ?>
    <?php
      require '../../assets/backend/HabbletDataBase.php';

      $db = HabbletDataBase::getInstance();

      $sql = 'SELECT * FROM noticias WHERE url = ?';
      $query = $db->prepare($sql);
      $query->bindValue(1, $_GET['key']);
      $query->execute();
      $news = $query->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="d-flex flex-column gap-3">
      <div class="d-flex align-items-center p-2 border rounded" style="height: 50px;">Titulo: <?php echo $news['titulo'] ?></div>
      <div class="d-flex align-items-center p-2 border rounded" style="height: 50px;">Autor: <?php echo $news['criador'] ?></div>
      <div class="d-flex align-items-center p-2 border rounded" style="height: 50px;">Resumo: <?php echo $news['resumo'] ?></div>
      <div class="d-flex align-items-center p-2 border rounded">
        <?php $news['texto'] ?>
      </div>
      <div id="status-form" class="d-flex align-items-center p-2 border rounded" style="height: 50px;">
        Status: 
        <label class="ms-3">
          <span>Ativo</span>
          <input type="radio" name="status" value="ativo"
          <?php echo $news['status'] == 'ativo' ? 'checked' : '' ?>>
        </label>
        <label class="ms-3">
          <span>Inativo</span>
          <input type="radio" name="status" value="inativo"
          <?php echo $news['status'] == 'inativo' ? 'checked' : '' ?>>
        </label>
      </div>
      <div>
        <button id="save-btn" class="btn btn-primary">Salvar alterações</button>
      </div>
    </div>
  <?php endif;?>
  </main>
  <script>
    let statusForm = document.querySelector('#status-form');
    let saveBtn = document.querySelector('#save-btn');
    saveBtn.onclick = () => {
      let input = statusForm.querySelector('input[type="radio"]:checked');
      let status = input.value;

      (async () => {
        let url = <?php echo $_GET['key']?>
        let res = await (await fetch('/painel/assets/backend/crud/noticia/update.php', {
          method: 'POST',
          body: {
            status,
            url
          }
        }));

      })();
    };
  </script>
</body>
</html>