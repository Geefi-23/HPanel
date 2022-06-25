<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: https://localhost');
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

  if (!$user->hasPermission(3))
    return print(json_encode([ 'error' => 'Você não tem permissão para fazer esta ação.' ]));

  $data = json_decode(file_get_contents('php://input'));

  $permissionsId = [];
  foreach ($data->permissoes as $p) {
    array_push($permissionsId, $p);
  }

  $sql = "DELETE FROM hp_cargos_permissions WHERE cargo = ? AND permission NOT IN (". implode(',', array_map('intval', $permissionsId)) .")";
  $query = $db->prepare($sql);
  $query->bindValue(1, $data->id);
  $query->execute();

  $sql = "INSERT INTO hp_cargos_permissions(cargo, permission) SELECT * FROM (SELECT ? as cargo, ? as permission) AS tmp 
        WHERE NOT EXISTS (SELECT permission FROM hp_cargos_permissions WHERE permission = ? AND cargo = ?) LIMIT 1";

  foreach ($data->permissoes as $p) {
    $query = $db->prepare($sql);
    $query->bindValue(1, $data->id, PDO::PARAM_INT);
    $query->bindValue(2, $p, PDO::PARAM_INT);
    $query->bindValue(3, $p, PDO::PARAM_INT);
    $query->bindValue(4, $data->id, PDO::PARAM_INT);
    try {
      $query->execute();
    } catch (PDOException $e) {
      return print(json_encode([ 'error' => $e->errorInfo ]));
    }
  }

  echo json_encode([ 'success' => 'Cargo atualizado com sucesso.'])
?>