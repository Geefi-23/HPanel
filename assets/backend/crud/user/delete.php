<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Token.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth'])) 
    return print(json_encode([ "error" => "Não autorizado" ]));

  $db = DataBase::getInstance();

  $requestAutorId = Token::decode($_COOKIE['hp_pages_auth'])[1]->sub;

  $sql = "SELECT cargo FROM hp_users WHERE id = ? AND cargo = 1";
  $query = $db->prepare($sql);
  $query->bindValue(1, $requestAutorId, PDO::PARAM_INT);
  $query->execute();
  $requestAutor = $query->fetch();

  if (!$requestAutor) {
    return print(json_encode([ "error" => "Você não tem permissão para realizar essa ação." ]));
  }

  $id = $_GET['id'];

  $sql = "DELETE FROM hp_users WHERE id = $id AND cargo != 1";
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