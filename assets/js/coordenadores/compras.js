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
    let cols = new Array(4).fill(0).map(() => document.createElement('td'));

    cols[0].innerText = compra.id;
    cols[1].innerText = compra.item;
    cols[2].innerText = compra.discord;
    cols[3].innerText = compra.codigo;
      
    row.append(...cols);

    let col = document.createElement('td');

    let solvedBadge = document.createElement('span');
    let checkedIcon = document.createElement('i');
    checkedIcon.className = "fa-solid fa-check me-2";
    solvedBadge.append(checkedIcon, "Resolvido");
    solvedBadge.classList.add('text-white', 'hp-bg-green', 'rounded', 'px-3', 'py-1');
    
    if (compra.resolvido === 'nao') {
      let btnSolve = document.createElement('button');
      btnSolve.innerText = "Marcar como resolvido";
      btnSolve.classList.add('hp-btn-success');
      btnSolve.onclick = async () => {

        const init = {
          method: 'POST',
          body: JSON.stringify({
            id: compra.id,
            resolvido: 'sim'
          }),
          credentials: 'include'
        };

        loader.show();
        const res = await api.compras('update', {}, init);
        loader.hide();

        if (res.success) {
          notif.dispatch('success', 'Sucesso', res.success);
          col.innerHTML = '';
          
          col.append(solvedBadge);
        } else {
          notif.dispatch('danger', 'Erro', res.error);
        }
      };

      col.append(btnSolve);
      row.append(col);
    } else {
      col.append(solvedBadge);
      row.append(col);
    }

    return row;
  });

  table.append(...rows);
};

window.onload = () => {
  handleLoadTable();
};