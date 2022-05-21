<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Token.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth'])) return print(json_encode([ "error" => "Não autorizado" ]));

  $data = json_decode(file_get_contents('php://input'));

  if (is_array($data)) {
    
    $sql = 'DELETE FROM hp_users WHERE id IN (';
    foreach ($data as $value) {
      $sql .= $value.',';
    }
    $sql = substr($sql, 0, strlen($sql) - 1);
    $sql .= ') AND cargo != 1';
  }
  $db = DataBase::getInstance();
  $query = $db->prepare($sql);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo var_dump($e->errorInfo);
  }
  $response = [
    "success" => "Usuário deletado com sucesso!"
  ];
  echo json_encode($response);
?>