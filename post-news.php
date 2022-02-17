<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="assets/lib/editor/editor.js"></script>
  <link rel="stylesheet" href="assets/lib/editor/editor.css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  
  <title>Postar notícia</title>
</head>
<body>
  <?php
    require 'assets/components/sidebar.php';
  ?>
  <div style="width: calc(100% - 225px);position: absolute;left: 225px; padding-left:20px">
      <h2 class="demo-text">Postagem De Noticias </h2>
      
      <div class="container">
        <div class="row">
          <div class="col-lg-12 nopadding">
            <input type="text" style="width: 700px;height:40px;border:1px solid #dee2e6;padding-left: 10px" placeholder="Título da notícia">
            <textarea id="txtEditor"></textarea> 
          </div>
        </div>
      </div>
  </div>
  <script>
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
    $(document).ready(function() {
				$("#txtEditor").Editor();
			});
  </script>
</body>
</html>