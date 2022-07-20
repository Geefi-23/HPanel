import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

const load = async () => {
  const lista = document.querySelector('#lista');

  loader.show();
  const res = await api.buyable('getall');
  loader.hide();

  const compraveis = res.map((compravel) => {
    let card = document.createElement('article');
    let imgContainer = document.createElement('div');
    let img = document.createElement('img');
    let name = document.createElement('h5');
    let value = document.createElement('p');
    let btn = document.createElement('a');
    let div = document.createElement('div');

    card.classList.add('buyable-card');
    btn.classList.add('hp-btn-primary', 'w-75', 'rounded');
    imgContainer.classList.add('buyable-card-img', 'mb-2');
    div.classList.add('d-flex', 'justify-content-center');

    name.innerText = compravel.nome;
    value.innerText = `Valor: ${compravel.valor} XD's`;
    img.src = api.getMedia(compravel.imagem);
    imgContainer.append(img);
    btn.innerText = "Gerenciar";
    btn.href = `gerenciando/${compravel.id}`;
    div.append(btn);

    card.append(imgContainer, name, value, div);

    return card;
  });

  lista.append(...compraveis);
};

window.onload = () => {
  load();
};