import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const userHighlightsDOM = document.querySelector('#user-highlights');
const userSearch = document.forms.userSearchForm;
const userResultList = document.querySelector('#user-search-results tbody');

const pool = async () => {
  const users = await api.hbtUsers('gethighlights');
};

const handleUserSearch = async evt => {
  evt.preventDefault();

  const q = evt.target.q.value;

  const users = await api.hbtUsers('search', {}, { method: 'POST', body: JSON.stringify({ value: q }) });

  userResultList.innerHTML = '';
  users.forEach((user) => {
    const row = document.createElement('tr');
    const cols = new Array(3).fill(document.createElement('td'));
    cols[0].innerText = user.id;
    cols[1].innerText = user.usuario;

    row.append(...cols);
    console.log(cols, row)
    userResultList.append(row);
  });
};

userSearchForm.onsubmit = handleUserSearch;