import loader from '../modules/Loader.js';
import notif from '../modules/notifications.js';
import api from '../modules/API.js';

const form = document.forms.valores;
const imageNameView = document.querySelector('#image-name');

form.imagem.onchange = function () {
  imageNameView.innerText = this.files[0].name;
};

form.categoria.onchange = (evt) => {
  if (evt.target.value === '3') { // raro ltd
    form.querySelector('#uploadimage-wrapper').classList.add('d-none');
    form.urlimagem.classList.remove('d-none');
  } else {
    form.querySelector('#uploadimage-wrapper').classList.remove('d-none');
    form.urlimagem.classList.add('d-none');
  }

};

const handleFormSubmit = async evt => {
  evt.preventDefault();

  const imagem = form.imagem.files[0];

  const data = {
    nome: form.nome.value,
    categoria: form.categoria.value,
    preco: form.preco.value,
    valorltd: form.valorltd.value,
    situacao: form.situacao.value,
    moeda: form.moeda.value,
    urlimagem: form.urlimagem.value
  };

  const formData = new FormData();
  formData.append('imagem', imagem);
  formData.append('data', JSON.stringify(data));

  const init = {
    method: 'POST',
    body: formData,
    credentials: 'include'
  };

  loader.show();
  const res = await api.values('save', {}, init);
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
    form.reset();
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};

form.onsubmit = handleFormSubmit;