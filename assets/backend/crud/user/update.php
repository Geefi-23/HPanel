<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Header: Content-Type');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Token.php';

  if (!isset($_COOKIE['hp_pages_auth']) || !Token::isValid($_COOKIE['hp_pages_auth'])) 
    return print(json_encode([ "error" => "Não autorizado" ]));

  $db = DataBase::getInstance();

  $requestAutorId = Token::decode($_COOKIE['hp_pages_auth'])[1]->sub;

  $sql = "SELECT cargo FROM hp_users WHERE id = ? AND cargo = 1";
  $query = $db->prepare($sql);
  $query->bindValue(1, $requestAutorId, PDO::PARAM_INT);
  $query->execute();
  $requestAutor = $query->fetch();

  if (!$requestAutor) {
    return print(json_encode([ "error" => "Você não tem permissão para realizar essa ação." ]));
  }

  $data = json_decode(file_get_contents('php://input'));
  
  $id = $data->id;
  $nome = $data->nome;
  $cargo = $data->cargo;

  $sql = 'UPDATE hp_users SET nome = ?, cargo = ? WHERE id = ?';
  $query = $db->prepare($sql);
  $query->bindValue(1, $id);
  $query->bindValue(2, $nome);
  $query->bindValue(3, $cargo);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo ]));
  }

  json_encode([ 'success' => 'Editado com sucesso.' ])
?>