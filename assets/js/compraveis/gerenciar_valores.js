import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

const load = async () => {
  const lista = document.querySelector('#lista');

  loader.show();
  const res = await api.values('getall');
  loader.hide();

  const compraveis = res.map((compravel) => {
    let card = document.createElement('article');
    let imgContainer = document.createElement('div');
    let img = document.createElement('img');
    let name = document.createElement('h5');
    let info = document.createElement('p');
    let btn = document.createElement('a');
    let btnWrapper = document.createElement('div');
    let spacer = document.createElement('div');

    card.classList.add('buyable-card');
    btn.classList.add('hp-btn-primary', 'w-75', 'rounded');
    imgContainer.classList.add('buyable-card-img', 'mb-2');
    btnWrapper.classList.add('d-flex', 'justify-content-center', 'position-absolute', 'w-100');
    btnWrapper.style.bottom = '.5rem';
    spacer.style.height = '40px';

    name.innerText = compravel.nome;

    info.innerText = `Valor na loja: ${compravel.preco} XD's
    Valor LTD: ${compravel.valorltd}
    Categoria: ${compravel.categoria}
    Moeda: ${compravel.moeda.charAt(0).toUpperCase()}${compravel.moeda.substring(1)}s
    Situação: ${compravel.situacao}`;

    img.src = compravel.categoria_id === "3" ? compravel.imagem : api.getMedia(compravel.imagem);
    imgContainer.append(img);
    btn.innerText = "Gerenciar";
    btn.href = `gerenciando-valor/${compravel.id}`;
    btnWrapper.append(btn);

    card.append(imgContainer, name, info, spacer, btnWrapper);

    return card;
  });

  lista.append(...compraveis);
};

window.onload = () => {
  load();
};