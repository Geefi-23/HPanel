<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Header: Content-Type');
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

  $data = json_decode(file_get_contents('php://input'));
  
  $id = $data->id;
  $nome = $data->nome;
  $cargo = $data->cargo;

  $sql = 'UPDATE hp_users SET nome = ?, cargo = ? WHERE id = ?';
  $query = $db->prepare($sql);
  $query->bindValue(1, $nome);
  $query->bindValue(2, $cargo);
  $query->bindValue(3, $id);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }

  echo json_encode([ 'success' => 'Editado com sucesso.' ])
?>