import api from "./modules/API.js";
import loader from "./modules/Loader.js";
import notif from './modules/notifications.js';

const regex = {
  nome: /[A-Za-z0-9_]{4,}/,
  senhaAtual: /.{6,18}/,
  senhaNova: /.{6,18}/,
  repetirSenhaNova: /.{6,18}/
};
const form = document.forms.updateAccount;
const inputs = {
  nome: form.nome,
  facebook: form.facebook,
  twitter: form.twitter,
  discord: form.discord,
  senhaAtual: form.senha,
  senhaNova: form.senhaNova,
  repetirSenhaNova: form.senhaNovaR,
};

window.onload = async () => {
  const id = JSON.parse(localStorage.getItem('hp_user')).id;
  loader.show();
  const user = await api.user('get', { id });
  loader.hide();

  inputs.nome.value = user.nome;
  inputs.facebook.value = user.facebook;
  inputs.twitter.value = user.twitter;
  inputs.discord.value = user.discord;
};

form.onsubmit = async evt => {
  evt.preventDefault();

  if (inputs.senhaNova.value !== inputs.repetirSenhaNova.value) {
    return notif.dispatch('danger', 'Erro', `A senha nova não coincide.`);
  }

  const data = {
    nome: inputs.nome.value,
    facebook: inputs.facebook.value,
    twitter: inputs.twitter.value,
    discord: inputs.discord.value,
    senha: inputs.senhaAtual.value,
    senhaNova: inputs.senhaNova.value
  };

  const init = {
    method: 'POST',
    body: JSON.stringify(data),
    credentials: 'include'
  };

  loader.show();
  const res = await api.user('updatemyaccount', {}, init);
  loader.hide();

  if (res.success) {
    notif.dispatch('success', 'Sucesso', res.success);
    window.location.hash = '#';
    setTimeout(() => {
      window.location.href = '/painel/login';
    }, 2000);
  } else {
    notif.dispatch('danger', 'Erro', res.error);
  }
};