import api from './modules/API.js';
import notif from './modules/notifications.js';
import loader from './modules/Loader.js';

const form = document.querySelector('#form-login');
const inputUsername = form.querySelector('#in-username');
const inputPassword = form.querySelector('#in-password');
const passVisibToggle = form.querySelector('#pass-visib-toggle');

passVisibToggle.onclick = () => {
  let visible = inputPassword.type === 'text';
  if (visible){
    passVisibToggle.querySelector('i').className = 'fa fa-eye';
    inputPassword.type = 'password';
  } else {
    passVisibToggle.querySelector('i').className = 'fa fa-eye-slash';
    inputPassword.type = 'text';
  }
    
};

form.onsubmit = async (evt) => {
  evt.preventDefault();

  let user = {
    nome: inputUsername.value,
    senha: inputPassword.value
  };

  if (user.nome === ''){
    inputUsername.classList.add('login-input--error');
    inputUsername.oninput = function() {
      this.classList.remove('login-input--error');
      this.oninput = null;
    };
    return notif.dispatch('danger', 'Erro', 'O campo Usuário está vazio!')
  }

  if (user.senha === ''){
    inputPassword.classList.add('login-input--error');
    inputPassword.oninput = function() {
      this.classList.remove('login-input--error');
      this.oninput = null;
    };
    return notif.dispatch('danger', 'Erro', 'O campo Senha está vazio!')
  }

  let init = {
    method: 'POST',
    body: JSON.stringify(user),
    headers: {
      'Content-Type': 'application/json'
    },
    credentials: 'include'
  };
  loader.show();
  let res = await api.user('get', {}, init);
  loader.hide();
  if (res.error) return notif.dispatch('danger', 'Erro', res.error);
  localStorage.setItem('hp_user', JSON.stringify(res.user));
  window.location.href = '/painel/';
}