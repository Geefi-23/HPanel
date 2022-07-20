import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const userHighlightsDOM = document.querySelector('#user-highlights');
const newsHighlightDOM = document.querySelector('#news-highlight');

const userSearchForm = document.forms.userSearchForm;
const setHighlightForm = document.forms.setHighlightForm;
const newsSearchForm = document.forms.searchnews;
const saveCarouselForm = document.forms.saveCarousel;

const newsResultList = document.querySelector('#news-search-results tbody');
const userResultList = document.querySelector('#user-search-results tbody');
const carouselResultsDOM = document.querySelector('#lista-carousel');

const loadHighlights = async () => {
  loader.show();
  const highlights = await api.hbtUsers('gethighlight');

  highlights.forEach((highlight) => {
    let wrapper = document.createElement('div');
    let card = document.createElement('article');
    let header = document.createElement('div');
    let reason = document.createElement('p');
    let pic = document.createElement('img');
    let name = document.createElement('h6');
    let deleteBtn = document.createElement('button');

    wrapper.classList.add('pt-4');
    card.classList.add('user-card');
    header.classList.add('header-wrapper');
    reason.classList.add('mt-2');
    pic.src = `https://avatar.blet.in/${highlight.usuario}&action=std&size=b&head_direction=3&direction=4&gesture=sml&headonly=0`;
    name.innerText = highlight.usuario;
    reason.innerText = highlight.motivo;
    deleteBtn.classList.add('hp-btn-danger');
    deleteBtn.innerText = 'Remover';

    deleteBtn.onclick = async () => {
      loader.show();
      const res = await api.hbtUsers('deletehighlight', { user: highlight?.usuario });
      loader.hide();

      if (res.success) {
        notif.dispatch('success', 'Sucesso', res.success);
        wrapper.remove();
      } else {
        notif.dispatch('danger', 'Erro', res.error);
      }
    };

    header.append(name, pic);
    card.append(header, reason, deleteBtn);
    wrapper.append(card);

    userHighlightsDOM.append(wrapper);
  });

  const newsHighlight = await api.news('gethighlight');

  let card = document.createElement('article');
  let title = document.createElement('h6');
  let resume = document.createElement('p');
  let removeBtn = document.createElement('button');

  removeBtn.classList.add('hp-btn-danger');
  removeBtn.innerText = 'Remover';
  removeBtn.onclick = async () => {
    loader.show();
    const res = await api.news('removehighlight', { id: newsHighlight.id });
    loader.hide();

    if (res.success) {
      notif.dispatch('success', 'Sucesso', res.success);
      card.remove();
    } else {
      notif.dispatch('danger', 'Erro', res.error);
    }
  };

  card.classList.add('news-card');
  title.append(newsHighlight.titulo);
  resume.append(newsHighlight.resumo);

  card.append(title, resume, removeBtn);
  newsHighlightDOM.append(card);

  loader.hide();
};

const loadCarousel = async () => {
  loader.show();
  const res = await api.carousel('get');
  loader.hide();

  res.forEach((c) => {
    let wrapper = document.createElement('a');
    let img = document.createElement('img');

    img.src = api.getMedia(c.imagem);
    wrapper.href = c.destino;

    wrapper.append(img);
    carouselResultsDOM.append(wrapper);
  });
};

const handleSaveCarousel = async (evt) => {
  evt.preventDefault();

  const formData = new FormData();
  formData.append('imagem', evt.target.imagem.files[0]);
  formData.append('destino', evt.target.destino.value);

  const init = {
    method: 'POST',
    body: formData,
    credentials: 'include'
  };

  loader.show();
  const res = await api.carousel('save', {}, init);
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};

const handleUserSearch = async evt => {
  evt.preventDefault();

  const q = evt.target.q.value;

  loader.show();
  const users = await api.hbtUsers('search', {}, { method: 'POST', body: JSON.stringify({ value: q }) });
  loader.hide();

  userResultList.innerHTML = '';
  users.forEach((user) => {
    const row = document.createElement('tr');
    const cols = new Array(3).fill(0).map(() => document.createElement('td'));
    const btnAdd = document.createElement('button');
    
    btnAdd.classList.add('hp-btn-success');
    btnAdd.innerText = 'Selecionar';

    btnAdd.onclick = () => {
      setHighlightForm.classList.remove('d-none');
      setHighlightForm.user.value = user.usuario;
      setHighlightForm.reason.placeholder = `Por que ${user.usuario} está sendo destacado(a)?`;
    };

    cols[0].innerText = user.id;
    cols[1].innerText = user.usuario;
    cols[2].append(btnAdd);
     

    row.append(...cols);
    console.log(cols, row)
    userResultList.append(row);
  });
};

const handleSetHighlight = async function(evt) {
  evt.preventDefault();

  const data = {
    usuario: this.user.value,
    motivo: this.reason.value
  };

  const init = {
    method: 'POST',
    body: JSON.stringify(data),
    credentials: 'include'
  };

  loader.show();
  const res = await api.hbtUsers('sethighlight', {}, init);
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
    this.classList.add('d-none');
    this.reset();
    loadHighlights();
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};

const handleSearchNews = async evt => {
  evt.preventDefault();

  loader.show();
  const news = await api.news('search', { q: evt.target.q.value });
  loader.hide();

  news.forEach(n => {
    const row = document.createElement('tr');
    const cols = new Array(4).fill(0).map(() => document.createElement('td'));
    const btn = document.createElement('button');

    btn.classList.add('hp-btn-success');
    btn.innerText = 'Setar destaque';
    btn.onclick = async () => {
      loader.show();
      const res = await api.news('sethighlight', { id: n.id });
      loader.hide();

      if (res.success) {
        notif.dispatch('success', 'Sucesso', res.success);
        window.location.hash = "#";
      } else {
        notif.dispatch('danger', 'Erro', res.error);
      }
    };

    cols[0].append(n.id);
    cols[1].append(n.titulo);
    cols[2].append(n.resumo);
    cols[3].append(btn);

    row.append(...cols);
    newsResultList.append(row);
  });
};

userSearchForm.onsubmit = handleUserSearch;
setHighlightForm.onsubmit = handleSetHighlight;
saveCarouselForm.onsubmit = handleSaveCarousel;
newsSearchForm.onsubmit = handleSearchNews;

loadHighlights();
loadCarousel();