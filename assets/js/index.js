const USER = JSON.parse(sessionStorage.getItem('user'));

const profileUsername = document.querySelector('#prof-username');
const profileRole = document.querySelector('#prof-role');

profileUsername.innerHTML = USER.nome;
profileRole.innerHTML = USER.nome_cargo;

const soAccordionTriggers = document.querySelectorAll('.so-accordion-trigger');

soAccordionTriggers.forEach((trigger) => {
  trigger.onclick = () => {
    let accordion = trigger.closest('li').querySelector('.accordion.sub-option-group');
    if (accordion.classList.contains('active'))
      accordion.classList.remove('active');
    else
      accordion.classList.add('active');
  };
});