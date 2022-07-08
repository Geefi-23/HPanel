import api from './modules/API.js';

window.onload = async () => {
  // carrega os cards
  const usersCountDOM = document.querySelector('#users-count');
  const annoucersCountDOM = document.querySelector('#announcers-count');

  const usersCount = await api.user('count');
  const announcersCount = await api.radioHorarios('count');

  usersCountDOM.innerText = usersCount;
  annoucersCountDOM.innerText = announcersCount;
};