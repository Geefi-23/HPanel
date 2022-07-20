import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

const form = document.forms.emblemas;

form.onsubmit = async (evt) => {
  evt.preventDefault();

  const data = {
    nome: form.nome.value,
    imagem: form.imagem.value,
    tutorial: '',
    gratis: 'nao',
    conquistado: form.conquistado.value,
    codigo: form.codigo.value,
    usuarios_qtd: form.usuarios_qtd.value
  };

  const init = {
    method: 'POST',
    body: JSON.stringify(data),
    credentials: 'include'
  };

  console.log(api)
  loader.show();
  const res = await api.emblemas('save', {}, init);
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};