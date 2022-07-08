<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Header: Content-Type');

  require '../../../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\DataBase;
  use Utils\HabbletDataBase;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  if (!$user->hasPermission(2)) {
    return print(json_encode([ 'error' => 'Você não tem permissão para realizar esta ação.' ]));
  }

  $db = DataBase::getInstance();

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $senha = md5($data->senha);
  $senha = substr($senha, 5);
  $cargo = $data->cargo;

  if ($nome == '' || $senha == '') {
    return print(json_encode([ 'error' => 'Algum dos campos está vazio.' ]));
  } elseif (preg_match('%\s+%', $nome) || preg_match('%\s+%', $senha)) {
    return print(json_encode([ 'error' => 'Caractére inválido.' ]));
  }

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