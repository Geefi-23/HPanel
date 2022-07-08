import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const table = document.querySelector('#table-horarios');
const dateSelect = document.querySelector('#data');

const dateFormat = (dateInstance) => {
  let day = ''+dateInstance.getDate();
  let month = ''+(dateInstance.getUTCMonth() + 1);
  let year = dateInstance.getFullYear();

  day = day.length < 2 ? '0'+day : day;
  month = month.length < 2 ? '0'+month : month;

  let formatted = [year, month, day].join('-');
  return formatted;
};

const date = new Date();
let current_registry_date = dateFormat(date);

const pool = async () => {
  loader.show();
  const horarios = await api.radioHorarios('getall', { date: current_registry_date });
  loader.hide();

  return horarios;
};

window.onload = () => {
  for (let i = 0; i < 7; i++) {
    let newDate = new Date();
    newDate.setDate(newDate.getDate() + i)
    
    let dia = newDate.getDate();
    let mes = newDate.getUTCMonth()+1;

    let option = document.createElement('option');
    option.innerText = `${dia}/${mes}`;
    option.value = dateFormat(newDate);
    dateSelect.append(option);
  }
};

const loadTable = async () => {
  const horarios = await pool();
  const rows = [];
  horarios.forEach((horario) => {
    
    const cols = [];
    for (let key in horario) {
      
      const col = document.createElement('td');

      if (horario[key] === '') {
        const btn = document.createElement('button');
        btn.innerText = 'Marcar horário';
        btn.className = 'hp-btn-primary';
        btn.onclick = async function() {
          const init = {
            method: 'POST',
            body: JSON.stringify({
              id: horario.id,
              date: current_registry_date
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
    if (horario.usuario) {
      const resetBtn = document.createElement('button');
      resetBtn.className = 'hp-btn-danger';
      resetBtn.innerText = 'Resetar';
      resetBtn.onclick = async function() {
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
      colResetBtn.append(resetBtn);
    }
    cols.push(colResetBtn);
    const row = document.createElement('tr');
    row.append(...cols);
    rows.push(row);
  })

  table.querySelector('tbody').innerHTML = '';
  table.querySelector('tbody').append(...rows);
};

loadTable();

dateSelect.onchange = function() {
  let date = new Date(this.value);
  date.setDate(date.getDate() + 1);
  current_registry_date = dateFormat(date);
  loadTable();
};