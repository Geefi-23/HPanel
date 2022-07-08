import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

const pool = async () => {
  loader.show();
  const news = await api.news('getall');
  loader.hide();

  let tabela = document.querySelector('#noticias');

  news.forEach(async (el) => {
    let card = document.createElement('a');
    let img = document.createElement('img');
    let resume = document.createElement('div');
    let strong = document.createElement('strong');
    let span = document.createElement('span');
    let small = document.createElement('small');

    const image = '/api/media/get.php?filename='+el.imagem;

    strong.append(el.titulo);
    span.insertAdjacentHTML('beforeend', el.resumo);
    small.append(el.criador);

    card.className = 'news-card';
    img.className = 'news-card__img';
    img.src = image;
    resume.className = 'news-card__resume';

    resume.append(strong, span, small);

    card.append(img, resume);
    card.href = '/painel/noticias/gerenciando/'+el.url;
    tabela.append(card);
  });
  
}

pool()