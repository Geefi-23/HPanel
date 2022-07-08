<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost/');
  header('Access-Control-Allow-Credentials: true');

  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;
  use Utils\Authenticate;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  if (!$user->hasPermission(6))
    return print(json_encode([ 'error' => 'Você não tem permissão para realizar esta operação.' ]));

  $db = DataBase::getInstance();

  $data = json_decode(file_get_contents('php://input'));
  
  $usuario = $user->getNome();
  $horarioID = $data->id;
  $dia = $data->date;

  $sql = "INSERT INTO hp_radio_horarios_marcados(usuario, horario, dia) VALUES(?, ?, ?)";
  $query = $db->prepare($sql);
  $query->bindValue(1, $usuario);
  $query->bindValue(2, $horarioID);
  $query->bindValue(3, $dia);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }

  echo json_encode([ 'success' => 'Horário marcado com sucesso.', 'username' => $user->getNome() ]);
?>