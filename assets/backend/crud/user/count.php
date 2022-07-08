<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Header: Content-Type');
  header('Access-Control-Allow-Credentials: true');

  require '../../../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\DataBase;

  if (!Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $db = DataBase::getInstance();
  $sql = "SELECT COUNT(id) AS usersCount FROM hp_users";
  $query = $db->prepare($sql);
  $query->execute();
  $result = $query->fetch(PDO::FETCH_ASSOC);

  echo $result['usersCount']
?>