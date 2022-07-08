import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

CKEDITOR.replace('noticiaEdit');

let form = document.forms.noticia;
let deleteBtn = document.querySelector('#delete-btn');
const statusToggleBtn = document.querySelector('#toggle-status-btn');
const statusView = document.querySelector('#status-view');
const statusValues = Array.from(form.status);

form.onsubmit = async evt => {
  evt.preventDefault();
  
  form.querySelector('button[type="submit"]').disabled = true;
  const data = {
    url,
    titulo: form.titulo.value,
    resumo: form.resumo.value,
    texto: CKEDITOR.instances.noticiaEdit.getData(),
    status: Array.from(form.status).filter(radio => radio.checked)[0].value
  };

  loader.show();
  const res = await api.news('update', {
    method: 'POST',
    body: JSON.stringify(data)
  });
  loader.hide();
  
  form.querySelector('button[type="submit"]').disabled = false;
  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
    window.location.href = '#';
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};

deleteBtn.onclick = async () => {
  loader.show();
  const res = await api.news('delete', {
    method: 'POST',
    body: JSON.stringify({ url })
  });
  loader.hide();

  if (res.success) {
    window.location.href = '/painel/noticias/gerenciar';
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};

statusToggleBtn.onclick = function() {
  if (this.classList.toggle('active')) {
    statusView.innerText = 'ativo';
    statusValues[0].checked = true;
  } else {
    statusView.innerText = 'inativo';
    statusValues[1].checked = true;
  }
  
}