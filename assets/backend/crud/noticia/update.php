<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Credentials: true');

  require '../../HabbletDataBase.php';
  require '../../DataBase.php';
  require '../../Token.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
    return print(json_encode([ 'erro' => 'Token de autenticação inválido!'])); //erro

  $data = json_decode(file_get_contents('php://input'));

  $db = HabbletDataBase::getInstance();

  $sql = 'UPDATE noticias SET status = ? WHERE url = ?';
  $query = $db->prepare($sql);
  $query->bindValue(1, $data->status);
  $query->bindValue(2, $data->url);
?>