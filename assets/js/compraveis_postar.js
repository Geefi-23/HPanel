import api from "./modules/API.js";
import loader from "./modules/Loader.js";
import notif from './modules/notifications.js';

const compraveisForm = document.forms.compraveis;
const submitBtn = compraveisForm.querySelector('button[type="submit"]');
const imageDir = compraveisForm.querySelector('#image-name');

compraveisForm.imagem.onchange = function() {
  imageDir.innerText = this.files[0].name;
};

compraveisForm.onsubmit = async evt => {
  evt.preventDefault();

  const imagem = compraveisForm.imagem.files[0];
  const data = {
    nome: compraveisForm.nome.value,
    valor: compraveisForm.valor.value,
    tipo: compraveisForm.tipo.value
  };

  for (let key in data) {
    if (data[key] === '') {
      return notif.dispatch('danger', 'Erro', 'Você não digitou nada no campo '+key);
    }
  }

  const formData = new FormData();
  formData.append('imagem', imagem);
  formData.append('data', JSON.stringify(data));

  const init = {
    method: 'POST',
    body: formData,
    credentials: 'include'
  };
  loader.show();
  submitBtn.disabled = true;

  let res = await api.buyable('save', init);
  submitBtn.disabled = false;
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
  }
};