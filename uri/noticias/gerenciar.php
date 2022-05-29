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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/painel/assets/css/reset.css">
  <link rel="stylesheet" href="/painel/assets/css/sidebar.css">
  <link rel="stylesheet" href="/painel/assets/css/manage-news.css">

  <title>Postar noticia</title>
</head>
<body>
  <?php
    require '../../assets/components/sidebar.php';
  ?>
  <main class="d-flex gap-3 flex-column p-3" id="noticias"></main>

  <script type="module">
    import API from '/painel/assets/js/modules/API.js';

    async function pool() {
      let res = await API.news('getall');

      let tabela = document.querySelector('#noticias');

      res.success.forEach((el) => {
        let card = document.createElement('a');
        let img = document.createElement('div');
        let resume = document.createElement('div');
        let strong = document.createElement('strong');
        let span = document.createElement('span');
        let small = document.createElement('small');

        let image = (async() => {
          let res = await (await fetch(`/api/media/images/${el.imagem}`)).json();
          console.log(res);
        })();

        strong.append(el.titulo);
        span.insertAdjacentHTML('beforeend', el.resumo);
        small.append(el.criador);

        card.className = 'news-card';
        img.className = 'news-card__img';
        resume.className = 'news-card__resume';

        resume.append(strong, span, small);

        card.append(img, resume);
        card.href = '/painel/noticias/gerenciando/'+el.url;
        tabela.append(card);
      });
      
    }

    pool()

    
  </script>
</body>
</html>