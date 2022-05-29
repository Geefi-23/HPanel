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

  <!-- CSS Only -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/colors.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/forms.css">
  <link rel="stylesheet" href="/painel/assets/css/notifications.css">

  <style>
    #loader-backdrop{
      position: absolute;
      display: none;
      justify-content: center;
      align-items: center;
      background-color: rgba(0, 0, 0, .3);
      height: 100vh;
      width: 100vw;
      top: 0;
      left: 0;
      z-index: 1061;
    }

    .loader-track{
      background-color: transparent;
      height: 60px;
      width: 60px;
      border: 4px solid #dee2e6;
      border-bottom-color: var(--hp-color-blue);
      border-radius: 50%;
      animation: spinning infinite 1s;
    }

    @keyframes spinning{
      from {
        transform: rotate(0deg)
      }

      to {
        transform: rotate(360deg)
      }
    }

  </style>

  <title>Postar noticia</title>
</head>
<body>
  <div id="loader-backdrop">
    <div class="loader-track"></div>
  </div>
  <div class="notifications"></div>
  <?php
    require '../../assets/components/sidebar.php';
  ?>
  <main class="p-3">
    <form name="noticia" class="post-form">
      <label style="width: 210px">
        <div class="file-input-btn">
          <i class="fa fa-download me-2"></i>
          Escolha uma imagem
        </div>
        <span id="image-name"></span>
        <input name="imagem" type="file" class="d-none" />
      </label>
      <input name="titulo" placeholder="Titulo" aria-placeholder="Titulo" autocomplete="off" />
      <textarea name="resumo" placeholder="Crie um bom resumo para a sua noticia" style="resize: none" aria-placeholder="Resumo"></textarea>
      <label style="width: 200px;border-color: #d1d1d1 !important" class="border rounded p-2">
        <span>Escolha uma categoria: </span>
        <select name="categoria">
          <option value="1">Moda</option>
        </select>
      </label>
      <textarea id="noticiaWriter"></textarea> 
      <button class="submit" type="submit">Enviar</button>
    </form>
  </main>
  <script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
  <script type="module">
    import notif from '/painel/assets/js/modules/notifications.js';

    const API = 'http://localhost:8000/api/'

    CKEDITOR.replace('noticiaWriter');

    let formNoticia = document.forms.noticia;

    formNoticia.imagem.onchange = function() {
      document.querySelector('#image-name').innerText = this.files[0].name;

    };

    formNoticia.onsubmit = async (evt) => {
      formNoticia.querySelector('button[type="submit"]').disabled = true;
      document.querySelector('#loader-backdrop').style.display = 'flex';
      evt.preventDefault();

      if (formNoticia.titulo === '' || formNoticia.resumo === '' || CKEDITOR.instances.noticiaWriter.getData() === '') {
        document.querySelector('#loader-backdrop').style.display = 'none';
        formNoticia.querySelector('button[type="submit"]').disabled = false;
        return alert('Algum dos campos não foi preenchido');
      }

      let formData = new FormData();
      
      let data = {
        criador: JSON.parse(localStorage.getItem('hp_user')).nome,
        titulo: formNoticia.titulo.value,
        resumo: formNoticia.resumo.value,
        categoria: formNoticia.categoria.value,
        texto: CKEDITOR.instances.noticiaWriter.getData()
      };

      formData.append('imagem', formNoticia.imagem.files[0]);
      formData.append('json', JSON.stringify(data));

      let res = await (await fetch(API+'news/save.php', {
        method: 'POST',
        body: formData,
        credentials: 'include'
      })).json();

      if (res.error)
        return notif.dispatch('danger', 'Erro', res.error);
      else notif.dispatch('success', 'Sucesso', res.success);

      document.querySelector('#loader-backdrop').style.display = 'none';
      formNoticia.querySelector('button[type="submit"]').disabled = false;
    };

  </script>
</body>
</html>