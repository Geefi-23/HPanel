<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://179.221.124.17/');
  header('Access-Control-Allow-Credentials: true');

  require '../../HabbletDataBase.php';
  require '../../Token.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
    return print(json_encode([ 'erro' => 'Token de autenticação inválido!'])); //erro

  $db = HabbletDataBase::getInstance();

  $sql = 'SELECT * FROM noticias';
  $query = $db->prepare($sql);
  
  try{
    $query->execute();
  } catch (PDOException $e) {
    echo json_encode([ 'erro' => $e->errorInfo ]);
  }

  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode([ 'success' => $results ]);
?>