import api from '../modules/API.js';
import notif from '../modules/notifications.js';
import loader from '../modules/Loader.js';

const table = document.querySelector('#cargos-table');
const editCargoForm = document.forms.editarcargo;
const cargos = await api.cargos('getall');

const loadTable = async () => {

  const loadEditForm = async (data) => {
    //roleBeignEdited = data;
    const addPermissionBtn = document.querySelector('#add-permission-formedit');
    const permListDOM = editCargoForm.querySelector('#permission-list');
    let roleID = data.id;
    const selectPerm = editCargoForm.permissao;
    selectPerm.innerHTML = '';
    permListDOM.innerHTML = '';
    let ps = cargos.permissions.filter(p => p.cargo === data.id);
    let psDOM = [];

    addPermissionBtn.onclick = () => {
    
      let permission = selectPerm.value;
      const li = document.createElement('li');
      li.innerText = selectPerm.querySelector(`option[value="${permission}"]`).innerText;
      ps.push(permission);
      permListDOM.append(li);
  
      selectPerm.querySelector(`option[value="${permission}"]`).remove();
    };

    const permissions = await api.permission('getall');
  
    permissions.forEach((perm) => {
      let option = document.createElement('option');
      option.innerText = perm.nome;
      option.value = perm.id;

      selectPerm.append(option);
    });

    editCargoForm.nome.value = data.nome;

    ps.forEach((p, i) => {
      let li = document.createElement('li');
      let btnRemove = document.createElement('button');
      btnRemove.innerText = 'X';
      btnRemove.className = 'btn btn-danger p-0 px-2 ms-2';
      btnRemove.onclick = function(evt)  {
        evt.currentTarget.parentNode.remove();
        ps.splice(i, 1);
      };
      li.append(p.nome, btnRemove);
      psDOM.push(li);
    })

    permListDOM.append(...psDOM);

    editCargoForm.onsubmit = async evt => {
      evt.preventDefault();

      const data = {
        id: roleID,
        nome: editCargoForm.nome.value,
        permissoes: ps.map(p => p.id || p)
      };
  
      const init = {
        method: 'POST',
        body: JSON.stringify(data),
        credentials: 'include'
      };
  
      loader.show();
      const res = await api.cargos('update', {}, init);
      loader.hide();
  
      if (res.success) { 
        notif.dispatch('success', 'Sucesso', res.success);
        window.location.href = '#';
      } else {
        notif.dispatch('danger', 'Erro', res.error);
      }
    };
  };

  const handleRowDelete = async (id, row) => {
    loader.show();
    const res = await api.cargos('delete', { id }, { credentials: 'include' });
    loader.hide();
    
    if (res.success) {
      notif.dispatch('success', 'Sucesso', res.success);
      row.remove();
    } else {
      notif.dispatch('danger', 'Erro', res.error);
    }
  };

  handleNewRoleForm();
  
  cargos.cargos.forEach(cargo => {
    let row = document.createElement('tr');
    let deletebtn = document.createElement('button');
    let editbtn = document.createElement('a');

    let colList = [];

    for (let key in cargo) {
      let col = document.createElement('td');
      col.innerText = cargo[key];
      colList.push(col);
    }

    let colPermissions = document.createElement('td');
    colPermissions.insertAdjacentHTML('beforeend', cargos.permissions.filter(p => p.cargo === cargo.id).map(p => p.nome).join('<br>'));
    colList.push(colPermissions);

    deletebtn.insertAdjacentHTML('beforeend', '<i class="fas fa-trash-alt"></i>');
    editbtn.insertAdjacentHTML('beforeend', '<i class="fas fa-pencil-alt"></i>');
    deletebtn.className = 'btn p-0';
    editbtn.className = 'btn p-0';
    editbtn.ariaRoleDescription = 'button';
    editbtn.href = '#modal-editarcargo';
    editbtn.onclick = () => {
      loadEditForm(cargo);
    }

    const colbtn1 = document.createElement('td');
    const colbtn2 = document.createElement('td');
    if (cargo.cargo_id !== "1"){
      colbtn1.append(editbtn);
      colbtn2.append(deletebtn);
    }
    
    colList.push(colbtn1, colbtn2);
    
    row.append(...colList);
    deletebtn.onclick = () => {
      handleRowDelete(cargo.id, row);
    };
    table.querySelector('tbody').append(row);


  });
};

const handleNewRoleForm = async () => {
  const permissionList = [];
  const form = document.forms.novocargo;
  const permissionListDOM = form.querySelector('#permission-list');
  const addPermissionBtn = form.querySelector('#add-permission');
  const selectPerm = form.permissao;

  const permissions = await api.permission('getall');
  
  permissions.forEach((perm) => {
    let option = document.createElement('option');
    option.innerText = perm.nome;
    option.value = perm.id;

    selectPerm.append(option);
  });
  
  addPermissionBtn.onclick = () => {
    
    let permission = selectPerm.value;
    const li = document.createElement('li');
    li.innerText = selectPerm.querySelector(`option[value="${permission}"]`).innerText;
    permissionList.push(permission);
    permissionListDOM.append(li);

    selectPerm.querySelector(`option[value="${permission}"]`).remove();
  };
  
  form.onsubmit = async evt => {
    evt.preventDefault();

    const data = {
      nome: form.nome.value,
      permissoes: permissionList
    };

    const init = {
      method: 'POST',
      body: JSON.stringify(data),
      credentials: 'include'
    };

    loader.show();
    const res = await api.cargos('save', {}, init);
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