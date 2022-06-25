<?php
  require '../../Authenticate.php';
  require '../../DataBase.php';
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

  if (!$user->hasPermission(7))
    return print(json_encode([ 'error' => 'Você não tem permissão para realizar esta operação.' ]));

  $toResetID = $_GET['id'];
  $sql = "UPDATE hp_radio_horarios SET usuario = '' WHERE id = $toResetID";
  $query = $db->prepare($sql);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }
  
  echo json_encode([ 'success' => 'Horário deletado com sucesso.' ]);
?>