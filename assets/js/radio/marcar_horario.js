import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const form = document.querySelector('#novo-horario-form');

form.onsubmit = async evt => {
  evt.preventDefault();

  const data = {
    horario
  };
};