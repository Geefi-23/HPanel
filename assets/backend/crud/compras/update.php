<?php
  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;
  use Utils\Authenticate;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  if (!$user->hasPermission(11)) {
    return print(json_encode([ 'error' => 'Você não tem autorização para realizar esta ação.' ]));
  }
  
  $data = json_decode(file_get_contents('php://input'));
  $db = DataBase::getInstance();

  $resolvido = $data->resolvido;
  $id = $data->id;
  $sql = "UPDATE hp_compras SET resolvido = ? WHERE id = ?";
  $query = $db->prepare($sql);
  $query->bindValue(1, $resolvido);
  $query->bindValue(2, $id, PDO::PARAM_INT);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'success' => 'Compra resolvida com sucesso.' ]));
  }

  echo json_encode([ 'success' => 'Compra resolvida com sucesso.' ]);
?>