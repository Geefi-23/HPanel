<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Header: Content-Type');

  require '../../DataBase.php';
  require '../../Token.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth'])) return print(json_encode([ "error" => "Não autorizado" ]));

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $senha = md5($data->senha);
  $senha = substr($senha, 5);
  $cargo = $data->cargo;

  $db = DataBase::getInstance();

  $sql = "SELECT * FROM hp_users WHERE nome = :nome";
  $query = $db->prepare($sql);
  $query->bindValue(':nome', $nome);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo var_dump($e->errorInfo);
  }

  if (!empty($query->fetch())) return print(json_encode([ "error" => "Este usuário já existe" ]));

  $sql = "INSERT INTO hp_users VALUES(null, :nome, :senha, :cargo, null)";
  $query = $db->prepare($sql);
  $query->bindValue(':nome', $nome);
  $query->bindValue(':senha', $senha);
  $query->bindValue(':cargo', $cargo);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo var_dump($e->errorInfo);
  }

  $sql = "SELECT u.id, u.nome, u.ultimo_login, hp_cargos.nome AS `cargo` FROM hp_users AS u 
  INNER JOIN hp_cargos ON hp_cargos.id = u.cargo 
  WHERE u.nome = :nome";
  $query = $db->prepare($sql);
  $query->bindValue(':nome', $nome);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo var_dump($e->errorInfo);
  }
  $user = $query->fetch(PDO::FETCH_ASSOC);

  $response = [
    "success" => "Usuário registrado com sucesso!",
    "user" => $user
  ];
  echo json_encode($response);
?>