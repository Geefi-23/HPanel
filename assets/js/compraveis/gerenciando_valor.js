import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

const form = document.forms.update_buyable;
const deleteBtn = document.querySelector('#delete-btn');

form.categoria.onchange = function() {
  if (this.value === "3") {
    form.emblema.classList.remove('d-none');
  } else {
    form.emblema.classList.add('d-none');
    form.emblema.value = '';
  }
};

form.onsubmit = async (evt) => {
  evt.preventDefault();

  const data = {
    id: form.id.value,
    nome: form.nome.value,
    icone: form.icone.value,
    preco: form.preco.value,
    valorltd: form.valorltd.value,
    moeda: form.moeda.value,
    situacao: form.situacao.value,
    categoria: form.categoria.value,
    emblema: form.emblema.value
  };

  const init = {
    method: 'POST',
    body: JSON.stringify(data),
    credentials: 'include'
  };

  loader.show();
  const res = await api.values('update', {}, init);
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
    window.location.hash = "#";
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};

deleteBtn.onclick = async () => {
  loader.show();
  const res = await api.values('delete', { id: form.id.value });
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
    window.location.hash = "#";
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};