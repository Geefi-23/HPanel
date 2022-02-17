<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Header: Content-Type');

  require '../../DataBase.php';
  require '../../Token.php';

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $senha = md5($data->senha);
  $senha = substr($senha, strlen($senha) / 2, strlen($senha)-3);

  $db = DataBase::getInstance();
  $sql = "SELECT u.*, hp_cargos.nome AS `nome_cargo` FROM hp_users AS u 
  INNER JOIN hp_cargos ON hp_cargos.id = u.cargo 
  WHERE u.nome = :nome AND u.senha = :senha;";
  $query = $db->prepare($sql); 
  $query->bindValue(':nome', $nome);
  $query->bindValue(':senha', $senha);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo $e->errorInfo;
  }
  $result = $query->fetch(PDO::FETCH_ASSOC);
  if (empty($result)) die(print(json_encode([ "error" => "Usuário não encontrado" ])));
  
  $jwt = Token::create($result['id']);
  $response = [
    "success" => "Usuário encontrado!",
    "user" => $result,
    'jwt' => $jwt
  ];
  echo json_encode($response);
?>