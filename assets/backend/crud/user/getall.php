<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Header: Content-Type');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Authenticate.php';

  if (!authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $db = DataBase::getInstance();
  $sql = 'SELECT u.id, u.nome, u.ultimo_login, u.ultimo_ip, c.id AS `cargo_id`, c.nome AS `cargo` 
          FROM hp_users AS u
          INNER JOIN hp_cargos AS c
          ON u.cargo = c.id';
  $query = $db->prepare($sql);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($result);
?>