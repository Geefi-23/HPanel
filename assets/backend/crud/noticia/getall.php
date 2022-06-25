<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://179.221.124.17/');
  header('Access-Control-Allow-Credentials: true');

  require '../../HabbletDataBase.php';
  require '../../Authenticate.php';

  if (!authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

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