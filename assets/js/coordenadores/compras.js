import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const table = document.querySelector('#compras tbody');

const handleLoadTable = async () => {
  loader.show();
  const compras = await api.compras('getall');
  loader.hide();

  const rows = compras.map((compra) => {
    let row = document.createElement('tr');
    
    for (let key in compra) {
      let col = document.createElement('td');
      col.innerText = compra[key];
      row.append(col);
    }

    return row;
  });

  table.append(...rows);
};

window.onload = () => {
  handleLoadTable();
};