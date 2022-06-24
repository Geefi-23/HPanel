<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Header: Content-Type');

  require '../../DataBase.php';
  require '../../Token.php';
  require '../../utils/Permissions.php';
  require '../../entities/User.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth'])) 
    return print(json_encode([ "error" => "Autenticação inválida." ]));

  $db = DataBase::getInstance();

  $requestAutorId = Token::decode($_COOKIE['hp_pages_auth'])[1]->sub;

  $sql = "SELECT * FROM hp_users WHERE id = ?";
  $query = $db->prepare($sql);
  $query->bindValue(1, $requestAutorId, PDO::PARAM_INT);
  $query->execute();
  $requestAutor = $query->fetch(PDO::FETCH_ASSOC);

  $user = new User($requestAutor);

  if (!$user->hasPermission(2)) {
    return print(json_encode([ 'error' => 'Você não tem permissão para realizar esta ação.' ]));
  }

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $senha = md5($data->senha);
  $senha = substr($senha, 5);
  $cargo = $data->cargo;

  $sql = "SELECT * FROM hp_users WHERE nome = :nome";
  $query = $db->prepare($sql);
  $query->bindValue(':nome', $nome);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo]));
  }

  if (!empty($query->fetch())) return print(json_encode([ "error" => "Este usuário já existe" ]));

  $sql = "INSERT INTO hp_users(nome, senha, cargo, ativo) VALUES(?, ?, ?, 'sim')";
  $query = $db->prepare($sql);
  $query->bindValue('1', $nome);
  $query->bindValue('2', $senha);
  $query->bindValue('3', $cargo);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo]));
  }

  $sql = "SELECT u.id, u.nome, u.ultimo_login, hp_cargos.nome AS `cargo` FROM hp_users AS u 
  INNER JOIN hp_cargos ON hp_cargos.id = u.cargo 
  WHERE u.nome = :nome";
  $query = $db->prepare($sql);
  $query->bindValue(':nome', $nome);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo]));
  }
  $user = $query->fetch(PDO::FETCH_ASSOC);

  $response = [
    "success" => "Usuário registrado com sucesso!",
    "user" => $user
  ];
  echo json_encode($response);
?>