<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost/');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Authenticate.php';
  require '../../utils/Permissions.php';
  require '../../entities/User.php';

  if (!authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $db = DataBase::getInstance();

  $requestAutorID = Token::decode($_COOKIE['hp_pages_auth'])[1]->sub;
  $sql = "SELECT * FROM hp_users WHERE id = $requestAutorID";
  $query = $db->prepare($sql);
  $query->execute();
  $requestAutor = $query->fetch(PDO::FETCH_ASSOC);
  $user = new User($requestAutor);

  if (!$user->hasPermission(6))
    return print(json_encode([ 'error' => 'Você não tem permissão para realizar esta operação.' ]));

  $data = json_decode(file_get_contents('php://input'));
  
  $usuario = $user->getNome();
  $horarioID = $data->id;

  $sql = "UPDATE hp_radio_horarios SET usuario = ? WHERE id = ?";
  $query = $db->prepare($sql);
  $query->bindValue(1, $usuario);
  $query->bindValue(2, $horarioID);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }

  echo json_encode([ 'success' => 'Horário marcado com sucesso.', 'username' => $user->getNome() ]);
?>