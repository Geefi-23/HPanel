<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: https://localhost');
  header('Access-Control-Allow-Credentials: true');

  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;
  use Utils\Authenticate;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  if (!$user->hasPermission(3))
    return print(json_encode([ 'error' => 'Você não tem permissão para fazer esta ação.' ]));

  $db = DataBase::getInstance();

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $permissionsId = [];
  foreach ($data->permissoes as $p) {
    array_push($permissionsId, $p);
  }

  $sql = "SELECT nome FROM hp_cargos WHERE id = ?";
  $query = $db->prepare($sql);
  $query->bindValue(1, $data->id);
  $query->execute();
  $result = $query->fetch();

  if ($result['nome'] != $nome) {
    $sql = "UPDATE hp_cargos SET nome = '$nome' WHERE id = ?";
    $query = $db->prepare($sql);
    $query->bindValue(1, $data->id);
    $query->execute();
  }

  if (!empty($permissionsId)) {
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
  }

  echo json_encode([ 'success' => 'Cargo atualizado com sucesso.'])
?>