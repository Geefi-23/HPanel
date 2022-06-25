<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Token.php';
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