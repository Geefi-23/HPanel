<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Header: Content-Type');

  require '../../DataBase.php';

  $data = json_decode(file_get_contents('php://input'));

  $nome = $data->nome;
  $senha = md5($data->senha);
  $senha = substr($senha, strlen($senha) / 2, strlen($senha)-3) + substr($senha, 2, strlen($senha) / 2);
  $cargo = $data->cargo;

  $db = DataBase::getInstance();
  $sql = "INSERT INTO hp_users VALUES(null, :nome, :senha, :cargo)";
  $query = $db->prepare($sql);
  $query->bindValue(':nome', $nome);
  $query->bindValue(':senha', $senha);
  $query->bindValue(':cargo', $cargo);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo $e->errorInfo;
  }
  $response = [
    "success" => "Usuário registrado com sucesso!"
  ];
  echo json_encode($response);
?>