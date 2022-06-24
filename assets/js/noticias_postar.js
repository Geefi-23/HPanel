import loader from './modules/Loader.js';
import notif from './modules/notifications.js';
import api from './modules/API.js';

CKEDITOR.replace('noticiaWriter');

const formNoticia = document.forms.noticia;
const noticiaSubmit = formNoticia.querySelector('button[type="submit"]');
const imageDirView = document.querySelector('#image-name');

formNoticia.imagem.onchange = function() {
  imageDirView.innerText = this.files[0].name;
};

formNoticia.onsubmit = async (evt) => {
  evt.preventDefault();
  
  if (formNoticia.titulo === '' || formNoticia.resumo === '' || CKEDITOR.instances.noticiaWriter.getData() === '') {
    return alert('Algum dos campos não foi preenchido');
  }
  
  const data = {
    titulo: formNoticia.titulo.value,
    resumo: formNoticia.resumo.value,
    categoria: formNoticia.categoria.value,
    texto: CKEDITOR.instances.noticiaWriter.getData()
  };

  for (let key in data) {
    if (data[key] === '')
      return notif.dispatch('danger', 'Erro', `O campo ${key} está vazio!`);
  }

  const formData = new FormData();
  formData.append('imagem', formNoticia.imagem.files[0]);
  formData.append('data', JSON.stringify(data));
  
  const init = {
    method: 'POST',
    body: formData,
    credentials: 'include'
  };

  loader.show();
  noticiaSubmit.disabled = true;
  let res = await api.news('save', init);
  loader.hide();
  noticiaSubmit.disabled = false;

  if (res.error)
    return notif.dispatch('danger', 'Erro', res.error);
  else notif.dispatch('success', 'Sucesso', res.success);
};