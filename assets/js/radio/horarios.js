import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const table = document.querySelector('#table-horarios');

const loadTable = async () => {
  loader.show();
  const horarios = await api.radioHorarios('getall');
  loader.hide();
  
  const rows = [];
  horarios.forEach((horario) => {
    
    const cols = [];
    for (let key in horario) {
      
      const col = document.createElement('td');

      if (horario[key] === '') {
        const btn = document.createElement('button');
        btn.innerText = 'Marcar horário';
        btn.className = 'text-white p-1 border-0 rounded-3'
        btn.style.background = '#054468';
        btn.onclick = async function() {
          const init = {
            method: 'POST',
            body: JSON.stringify({
              id: horario.id
            }),
            credentials: 'include'
          };

          loader.show();
          const res = await api.radioHorarios('save', {}, init);
          loader.hide();

          if (res.success) {
            notif.dispatch('success', 'Sucesso', res.success);
            let thisCol = this.parentNode;
            this.remove();
            thisCol.append(res.username);
          } else {
            notif.dispatch('danger', 'Erro', res.error);
          }
        };

        col.append(btn);
      } else {
        col.append(horario[key]);
      }
      
      cols.push(col);
    }

    const colResetBtn = document.createElement('td');
    const resetBtn = document.createElement('button');
    resetBtn.className = 'btn btn-danger p-0 px-2';
    resetBtn.innerText = 'Resetar';
    resetBtn.onclick = async () => {
      loader.show();
      const res = await api.radioHorarios('delete', { id: horario.id });
      loader.hide();
      
      if (res.success) {
        notif.dispatch('success', 'Sucesso', res.success);
        let thisCol = this.parentNode;
        this.remove();
        thisCol.append(res.username);
      } else {
        notif.dispatch('danger', 'Erro', res.error);
      }
    };
    colResetBtn.append(resetBtn)
    cols.push(colResetBtn);

    const row = document.createElement('tr');
    row.append(...cols);
    rows.push(row);
  })

  table.querySelector('tbody').append(...rows);
};

loadTable();