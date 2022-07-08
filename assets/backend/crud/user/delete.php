<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Credentials: true');

  require '../../../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\DataBase;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  if (!$user->hasPermission(2)) {
    return print(json_encode([ "error" => "Você não tem permissão para realizar essa ação." ]));
  }
  
  $db = DataBase::getInstance();

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