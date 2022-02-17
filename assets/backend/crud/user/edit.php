<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Header: Content-Type');

  require '../../DataBase.php';

  $data = json_decode(file_get_contents('php://input'));

  $id = $data->id;
  $nome = $data->nome;
  $senha = md5($data->senha);
  $senha = substr($senha, strlen($senha) / 2, strlen($senha)-3) + substr($senha, 2, strlen($senha) / 2);
  $cargo = $data->cargo;

  $db = DataBase::getInstance();
  $sql = 'UPDATE hp_users SET nome = :nome, senha = :senha, cargo = :cargo WHERE id = :id';
  $query = $db->prepare($sql);
  $query->bindValue(':nome', $nome);
  $query->bindValue(':senha', $senha);
  $query->bindValue(':cargo', $cargo);
  $query->bindValue(':id', $id);
  try {
    $query->execute();
  } catch (PDOException $e) {
    echo $e->errorInfo;
  }
  $response = [
    "success" => "Usuário editado com sucesso!"
  ];
  echo json_encode($response);
?>