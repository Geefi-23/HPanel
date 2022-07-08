<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: https://localhost');
  header('Access-Control-Allow-Credentials: true');

  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;
  use Utils\Authenticate;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $db = DataBase::getInstance();

  if (!$user->hasPermission(3)) {
    return print(json_encode([ 'error' => 'Você não tem autorização para realizar esta ação.', 'perms' => $user->getPermissions() ]));
  }

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $permissions = $data->permissoes;

  if ($nome === '' || empty($permissions))
    return print(json_encode([ 'error' => 'Algo está vazio!' ]));

  $sql = 'INSERT INTO hp_cargos VALUES(null, ?)';
  $query = $db->prepare($sql);
  $query->bindValue(1, $nome);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }

  $sql = 'SELECT id FROM hp_cargos ORDER BY id DESC LIMIT 1';
  $query = $db->prepare($sql);
  $query->bindValue(1, $nome);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }
  $id = $query->fetch()['id'];
  
  foreach ($permissions as $permission) {
    $sql = 'INSERT INTO hp_cargos_permissions VALUES(null, ?, ?)';
    $query = $db->prepare($sql);
    $query->bindValue(1, $id);
    $query->bindValue(2, $permission);
    try {
      $query->execute();
    } catch (PDOException $e) {
      return print(json_encode([ 'error' => $e->errorInfo ]));
    }
  }

  echo json_encode([ 'success' => 'Cargo salvo com sucesso' ]);
?>