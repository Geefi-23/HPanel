<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://179.221.124.17/');
  header('Access-Control-Allow-Credentials: true');

  require '../../HabbletDataBase.php';
  require '../../DataBase.php';
  require '../../Authenticate.php';

  if (!authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $hbdb = HabbletDataBase::getInstance();
  $db = DataBase::getInstance();

  $data = json_decode($_POST['json']);
  $dir = '../../images/';

  $user = Token::decode($_COOKIE['hp_pages_auth'])[1];
  $query = $db->prepare("SELECT * FROM hp_users WHERE id = ".$user->sub);
  $query->execute();
  $user = $query->fetch(PDO::FETCH_ASSOC);

  $titulo = $data->titulo;
  $resumo = $data->resumo;
  $categoria = $data->categoria;
  $criador = $user['nome'];
  $texto = $data->texto;
  $date = time();
  $url;

  // URL GENERATOR
  while(true){
    $key = str_replace('', '=', base64_encode(random_int(0, 9999999)));
    
    $sql = 'SELECT * FROM noticias WHERE url = ?';
    $query = $hbdb->prepare($sql);
    $query->bindValue(1, $key);
    try {
      $query->execute();
    } catch (PDOException $e) {
      return print(json_encode([ 'erro' => $e->errorInfo ]));
    }

    if (empty($query->fetch())) {
      $url = $key;
      break;
    }
  }

  $imgname = '';

  if ($titulo == '' || $resumo == '' || $texto == ''){
    return print(json_encode([ 'error' => 'Algum dos campos não foi preenchido' ]));
  }

  if (isset($_FILES['imagem'])){
    $ext = '.'.preg_replace("#\?.*#", "", pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $imgname = str_replace('', '=', base64_encode($_FILES['imagem']['name'].'ekwd1"s').$ext);
  }

  $sql = "INSERT INTO noticias(titulo, resumo, categoria, imagem, criador, url, texto, revisado, data, status, visualizacao, dia_evento, data_evento) 
  VALUES(?, ?, ?, ?, ?, ?, ?, '', ?, 'ativo', '', '', '')";
  $query = $hbdb->prepare($sql);
  $query->bindValue(1, $titulo);
  $query->bindValue(2, $resumo);
  $query->bindValue(3, $categoria);
  $query->bindValue(4, $imgname);
  $query->bindValue(5, $criador);
  $query->bindValue(6, $url);
  $query->bindValue(7, $texto);
  $query->bindValue(8, $date);
  $query->execute();

  echo json_encode([ 'success' => 'Notícia postada com sucesso' ]);
?>