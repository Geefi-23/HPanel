<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';
  require '../../Token.php';

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $senha = md5($data->senha);
  $senha = substr($senha, 5);

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
  ];

  header("Set-Cookie: hp_pages_auth={$jwt}; path=/;");
  echo json_encode($response);
?>