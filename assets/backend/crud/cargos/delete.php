<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: https://localhost');
  header('Access-Control-Allow-Credentials: true');

  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;
  use Utils\Authenticate;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  if (!$user->hasPermission(3)) {
    return print(json_encode([ 'error' => 'Você não tem autorização para realizar esta ação.', 'perms' => $user->getPermissions() ]));
  }

  $db = DataBase::getInstance();

  $id = $_GET['id'];

  if ($id == 1) {
    return print(json_encode([ 'error' => 'Você não pode deletar o Diretor.' ]));
  }
  
  $sql = "DELETE FROM hp_cargos_permissions WHERE cargo = $id";
  $query = $db->prepare($sql);
  $query->execute();
  
  $sql = "DELETE FROM hp_cargos WHERE id = $id";
  $query = $db->prepare($sql);
  $query->execute();

  echo json_encode([ 'success' => 'Cargo deletado com sucesso.' ]);
?>