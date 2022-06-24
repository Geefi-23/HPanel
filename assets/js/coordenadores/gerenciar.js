import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

let memberBeignEdited = null;

const loadTable = async () => {
  const table = document.querySelector('#members-table');
  const addMemberForm = document.forms.addMember;
  const editMemberForm = document.forms.editMember;
  const members = await api.user('getall');

  const loadEditForm = (data) => {
    memberBeignEdited = data;
    editMemberForm.nome.value = data.nome;
    editMemberForm.cargo.value = data.cargo_id;
  };

  const handleRowDelete = async (id, row) => {
    loader.show();
    const res = await api.user('delete', { id });
    loader.hide();

    if (res.success) {
      notif.dispatch('success', 'Sucesso', res.success);
      row.remove();
    } else {
      notif.dispatch('danger', 'Erro', res.error);
    }
  };
  
  members.forEach(member => {
    let row = document.createElement('tr');
    let deletebtn = document.createElement('button');
    let editbtn = document.createElement('a');

    let formmatedLastLogin = new Date(member.ultimo_login*1000);
    let D = formmatedLastLogin.getDate();
    let M = formmatedLastLogin.getMonth()+1;
    let Y = formmatedLastLogin.getFullYear();

    let h = formmatedLastLogin.getHours();
    let m = formmatedLastLogin.getMinutes();
    let s = formmatedLastLogin.getSeconds();

    formmatedLastLogin = `
      ${D < 10 ? '0'+D : D}/
      ${M < 10 ? '0'+M : M}/
      ${Y < 10 ? '0'+Y : Y} 
      às 
      ${h < 10 ? '0'+h : h}:
      ${m < 10 ? '0'+m : m}:
      ${s < 10 ? '0'+s : s}
    `.replaceAll(/\n/g, '');

    member.ultimo_login = formmatedLastLogin;

    let colList = [];

    for (let key in member) {
      if (key !== 'cargo_id') {
        let col = document.createElement('td');
        col.innerText = member[key];
        colList.push(col);
      }
    }

    deletebtn.insertAdjacentHTML('beforeend', '<i class="fas fa-trash-alt"></i>');
    editbtn.insertAdjacentHTML('beforeend', '<i class="fas fa-pencil-alt"></i>');
    deletebtn.className = 'btn p-0';
    editbtn.className = 'btn p-0';
    editbtn.ariaRoleDescription = 'button';
    editbtn.href = '#modal-editarmembro';
    editbtn.onclick = () => {
      loadEditForm(member);
    }

    const colbtn1 = document.createElement('td');
    const colbtn2 = document.createElement('td');
    if (member.cargo_id !== "1"){
      colbtn1.append(editbtn);
      colbtn2.append(deletebtn);
    }
    
    colList.push(colbtn1, colbtn2);
    
    row.append(...colList);
    deletebtn.onclick = () => {
      handleRowDelete(member.id, row);
    };
    table.querySelector('tbody').append(row);


  });

  addMemberForm.onsubmit = async evt => {
    evt.preventDefault();

    const data = {
      nome: addMemberForm.nome.value,
      senha: addMemberForm.senha.value,
      cargo: addMemberForm.cargo.value
    };

    const init = {
      method: 'POST',
      body: JSON.stringify(data),
      credentials: 'include'
    };

    loader.show();
    const res = await api.user('save', {}, init);
    loader.hide();

    if (res.success) { 
      notif.dispatch('success', 'Sucesso', res.success);
      window.location.href = '#';
    } else {
      notif.dispatch('danger', 'Erro', res.error);
    }
  };

  editMemberForm.onsubmit = async evt => {
    evt.preventDefault();

    const data = {
      id: memberBeignEdited.id,
      nome: editMemberForm.nome.value,
      cargo: editMemberForm.cargo.value
    };

    const init = {
      method: 'POST',
      body: JSON.stringify(data),
      credentials: 'include'
    };

    loader.show();
    const res = await api.user('update', {}, init);
    loader.hide();

    if (res.success) { 
      notif.dispatch('success', 'Sucesso', res.success);
      window.location.href = '#';
    } else {
      notif.dispatch('danger', 'Erro', res.error);
    }
  };
};

loadTable();