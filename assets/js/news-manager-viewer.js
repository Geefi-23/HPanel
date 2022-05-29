import notif from '/painel/assets/js/modules/notifications.js';

CKEDITOR.replace('noticiaEdit');

let form = document.forms.noticia;
let deleteBtn = document.querySelector('#delete-btn');

form.onsubmit = (evt) => {
  evt.preventDefault();
  form.querySelector('button[type="submit"]').disabled = true;
  let data = {
    url,
    titulo: form.titulo.value,
    resumo: form.resumo.value,
    texto: CKEDITOR.instances.noticiaEdit.getData(),
    status: Array.from(form.status).filter(radio => radio.checked)[0].value
  };
  (async () => {
    let res = await (await fetch('/painel/assets/backend/crud/noticia/update.php', {
      method: 'POST',
      body: JSON.stringify(data)
    })).json();
    
    form.querySelector('button[type="submit"]').disabled = false;
    if (res.success) {
      notif.dispatch('success', 'Sucesso', res.success);
      window.location.href = '#';
    }
  })();
};

deleteBtn.onclick = () => {
  
  (async () => {

    let res = await (await fetch('/painel/assets/backend/crud/noticia/delete.php', {
      method: 'POST',
      body: JSON.stringify({ url })
    })).json();

    if (res.success) {
      window.location.href = '/painel/noticias/gerenciar';
    }
  })();
};