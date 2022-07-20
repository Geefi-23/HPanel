import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

const form = document.forms.update_buyable;
const statusToggleBtn = document.querySelector('#toggle-status-btn');
const statusView = document.querySelector('#status-view');
const freeValues = Array.from(form.gratis);
const deleteBtn = document.querySelector('#delete-btn');

form.onsubmit = async (evt) => {
  evt.preventDefault();

  const data = {
    id: form.id.value,
    nome: form.nome.value,
    valor: form.valor.value,
    tipo: form.tipo.value,
    gratis: form.gratis.value
  };

  const init = {
    method: 'POST',
    body: JSON.stringify(data),
    credentials: 'include'
  };

  loader.show();
  const res = await api.buyable('update', init);
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
  const res = await api.buyable('delete', init);
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
    window.location.hash = "#";
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};

statusToggleBtn.onclick = function() {
  if (this.classList.toggle('active')) {
    statusView.innerText = 'sim';
    freeValues[0].checked = true;
  } else {
    statusView.innerText = 'nao';
    freeValues[1].checked = true;
  }
}