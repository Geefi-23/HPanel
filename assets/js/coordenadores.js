import API from './modules/API.js';

let membertable = document.querySelector('#member-table');

window.onload = async () => {
  let allUsers = await API.user('getall');
  let allRoles = await API.user('getallcargos');

  allUsers.forEach((user) => {
    addUserToTable(user);
  });

  let hpModal = document.querySelector('.hp-modal');
  let btnRegister = document.querySelector('#btn-register');
  let btnDelete = document.querySelector('#btn-delete');
  let btnEdit = document.querySelector('#btn-edit');
  let manageSelected = document.querySelector('.manage-selected')
  let manageSelectedIsShow = false;

  const toggleManageSelected = () => {
    let isChecked = document.querySelector('.select-user:checked');
    manageSelectedIsShow = isChecked ? true : false;

    if (manageSelectedIsShow) manageSelected.classList.remove('invisible');
    else manageSelected.classList.add('invisible');
  };

  let checkboxes = document.querySelectorAll('.select-user');
  checkboxes.forEach((checkbox, i) => {
    checkbox.value = allUsers[i].id;
    checkbox.onclick = function(){
      toggleManageSelected();
    };
  });

  btnRegister.onclick = () => {
    hpModal.classList.remove('invisible');
  };

  btnDelete.onclick = async () => {
    let checkedBoxes = document.querySelectorAll('.select-user:checked');
    let toDelete = [];
    checkedBoxes.forEach((checkbox) => {
      toDelete.push(checkbox.value);
      checkbox.closest('tr').remove();
      
    });
    let res = await API.user('delete', { method: 'POST', body: JSON.stringify(toDelete), credentials: 'include' });
    alert(res.success);
  };

  let formSaveUser = document.querySelector('#form-saveUser');
  let inputUsername = formSaveUser.querySelector('#input-username');
  let inputTemppass = formSaveUser.querySelector('#input-temppass');
  let roleSelect = formSaveUser.querySelector('#role-select');

  formSaveUser.onsubmit = async (evt) => {
    evt.preventDefault();
  
    let data = {
      nome: inputUsername.value,
      senha: inputTemppass.value,
      cargo: roleSelect.value
    };

    let init ={
      method: 'POST',
      body: JSON.stringify(data),
      credentials: 'include'
    };
    let res = await API.user('save', init);
    if (res.error) return alert(res.error);

    addUserToTable(res.user);
  };

  allRoles.forEach((role) => {
    roleSelect.innerHTML += `
      <option value="${role.id}">${role.nome}</option>
    `;
  })
};

const addUserToTable = (user) => {
  let tbody = membertable.querySelector('tbody');
  let tr = document.createElement('tr');
  tr.innerHTML = `<th scope="row">${user.id}</th>
  <td>${user.nome}</td>
  <td>${user.ultimo_login}</td>
  <td>${user.cargo}</td>
  <input type="checkbox" class="select-user position-absolute" style="right: 10px;top: 15px" />`
  ;
  tr.className = 'position-relative';
  tbody.append(tr);
};