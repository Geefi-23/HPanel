import api from './modules/API.js';

const form = document.querySelector('#form-login');
const inputUsername = form.querySelector('#in-username');
const inputPassword = form.querySelector('#in-password');

form.onsubmit = async (evt) => {
  evt.preventDefault();

  let user = {
    nome: inputUsername.value,
    senha: inputPassword.value
  };

  let res = await api.user('get', user);
  if (res.error) return alert(res.error);
  sessionStorage.setItem('user', JSON.stringify(res.user));
  document.cookie = 'jwt='+res.jwt;
  window.location.href = '/';
}