<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: https://localhost');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Token.php';
  require '../../utils/Permissions.php';
  require '../../entities/User.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth']))
    return print(json_encode([ 'erro' => 'Token de autenticação inválido!']));

  $db = DataBase::getInstance();

  $requestAutorId = Token::decode($_COOKIE['hp_pages_auth'])[1]->sub;

  $sql = "SELECT * FROM hp_users WHERE id = ?";
  $query = $db->prepare($sql);
  $query->bindValue(1, $requestAutorId, PDO::PARAM_INT);
  $query->execute();
  $requestAutor = $query->fetch();

  $user = new User($requestAutor);

  if (!$user->hasPermission(3)) {
    return print(json_encode([ 'error' => 'Você não tem autorização para realizar esta ação.', 'perms' => $user->getPermissions() ]));
  }

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