const months = [
  'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
];
const welcomePhrase = document.querySelector('#welcome-phrase');
const formmatedDate = document.querySelector('#formmated-date');
const clock = document.querySelector('#clock');
let welcome = '';
let formmated = '';

setInterval(() => {
  let data = new Date();
  let
    day = data.getDay(),
    month = data.getMonth(),
    year = data.getFullYear(),
    h = data.getHours(),
    m = data.getMinutes(),
    s = data.getSeconds();
  
  if (h >= 0 && h < 12){
    welcome = 'Bom dia';
  } else if (h >= 12 && h < 18) {
    welcome = ' Boa tarde';
  } else if (h >= 19 && h < 24) {
    welcome = 'Boa noite';
  }

  formmated = `${day + 1} de ${months[month]} de ${year}`

  if (welcomePhrase.innerText !== welcome) 
    welcomePhrase.innerText = welcome;

  if (formmatedDate.innerText !== formmated) 
    formmatedDate.innerText = formmated;

  let strhour = h < 10 ? '0'+h : h; 
  let strminutes = m < 10 ? '0'+m : m; 
  let strseconds = s < 10 ? '0'+s : s; 

  clock.innerText = `${strhour}:${strminutes}:${strseconds}`;
}, 1000);