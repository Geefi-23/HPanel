import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const table = document.querySelector('#table-pedidos tbody');

const pool = async () => {
  loader.show();
  const pedidos = await api.radioRequests('getall');
  loader.hide();

  pedidos.forEach((pedido) => {
    const row = document.createElement('tr');
    const cols = new Array(5).fill(0).map(() => document.createElement('td'));

    cols[0].append(pedido.id);
    cols[1].append(pedido.usuario);
    cols[2].append(pedido.pedido);
    cols[3].append(pedido.hora);

    const btn = document.createElement('button');
    btn.classList.add('hp-btn-success');
    btn.innerText = 'Concluir pedido';
    btn.onclick = async () => {
      loader.show();
      const res = await api.radioRequests('delete', { id: pedido.id });
      loader.hide();

      if (res.success) {
        notif.dispatch('success', 'Sucesso', res.success);
      } else {
        notif.dispatch('danger', 'Erro', res.error);
      }
    };
    cols[4].append(btn);

    row.append(...cols);
    table.append(row);
  });
};

window.onload = () => {
  pool();
};