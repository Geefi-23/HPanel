<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://179.221.124.17/');
  header('Access-Control-Allow-Credentials: true');

  require '../../HabbletDataBase.php';
  require '../../DataBase.php';
  require '../../Token.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
    return print(json_encode([ 'erro' => 'Token de autenticação inválido!'])); //erro

  $data = json_decode(file_get_contents('php://input'));

  $db = HabbletDataBase::getInstance();

  $url = $data->url;

  $sql = 'DELETE FROM noticias WHERE url = ?';
  $query = $db->prepare($sql);
  $query->bindValue(1, $url);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => 'Não foi possível deletar esta notícia', 'details' => $e->errorInfo ]));
  }

  echo json_encode([ 'success' => 'Noticia deletada com sucesso' ]);
?>