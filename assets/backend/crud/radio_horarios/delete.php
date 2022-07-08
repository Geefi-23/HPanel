<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost/');
  header('Access-Control-Allow-Credentials: true');
  
  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\DataBase;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  if (!$user->hasPermission(7))
    return print(json_encode([ 'error' => 'Você não tem permissão para realizar esta operação.' ]));

  $db = DataBase::getInstance();

  $toResetID = $_GET['id'];
  $sql = "DELETE FROM hp_radio_horarios_marcados WHERE id = $toResetID";
  $query = $db->prepare($sql);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }
  
  echo json_encode([ 'success' => 'Horário deletado com sucesso.' ]);
?>