<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Header: Content-Type');

  require '../../DataBase.php';
  require '../../Token.php';

  $matches;
  if (!preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)){
    header('HTTP/1.0 400 Bad Request');
    die(print(json_encode([ "error" => "Você não está autorizado" ])));
  }
    
  $jwt = $matches[1];
  if (!$jwt) {
    header('HTTP/1.0 400 Bad Request');
  }

  if(!Token::isValid($jwt))
    die(print(json_encode([ "error" => "O token fornecido é inválido!" ])));

  $data = json_decode(file_get_contents('php://input'));

  $id = $data->id;

  $db = DataBase::getInstance();
  $sql = 'DELETE FROM hp_users WHERE id = :id';
  $query = $db->prepare($sql);
  $query->bindParam(':id', $id);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo $e->errorInfo;
  }
  $response = [
    "success" => "Usuário deletado com sucesso!"
  ];
  echo json_encode($response);
?>