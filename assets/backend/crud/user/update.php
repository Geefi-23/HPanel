<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Header: Content-Type');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../utils/Permissions.php';
  require '../../entities/User.php';
  require '../../Authenticate.php';

  if (!authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $db = DataBase::getInstance();

  $requestAutorId = Token::decode($_COOKIE['hp_pages_auth'])[1]->sub;

  $sql = "SELECT * FROM hp_users WHERE id = ?";
  $query = $db->prepare($sql);
  $query->bindValue(1, $requestAutorId, PDO::PARAM_INT);
  $query->execute();
  $requestAutor = $query->fetch(PDO::FETCH_ASSOC);

  $user = new User($requestAutor);

  if (!$user->hasPermission(2)) {
    return print(json_encode([ "error" => "Você não tem permissão para realizar essa ação." ]));
  }

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