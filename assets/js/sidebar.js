
const sidebar = document.querySelector('#sidebar');
const userArea = document.querySelector('#user-area');
const userAreaName = userArea.querySelector('#user-area__name');
const userAreaRole = userArea.querySelector('#user-area__role');
const navLinks = sidebar.querySelectorAll('.nav__menu .nav__link a');

const setActive = (index) => {
  navLinks.forEach((link, i) => {
    if (i !== index){
      link.classList.remove('active');
    } else {
      link.classList.add('active');
    }
    
  });
};

const loadUser = () => {
  let hpUser = JSON.parse(localStorage.getItem('hp_user'));
  userAreaName.innerText = hpUser.nome;
  userAreaRole.innerText = hpUser.nome_cargo;
};

loadUser();

navLinks.forEach((link, i) => {
  link.onclick = () => {
    setActive(i);
  };
});