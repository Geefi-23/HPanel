<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Header: Content-Type');
  header('Access-Control-Allow-Credentials: true');

  require '../../../../vendor/autoload.php';

  use Utils\Authenticate;
  use Utils\DataBase;

  if (!$user = Authenticate::authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $db = DataBase::getInstance();
  $data = json_decode(file_get_contents('php://input'));
  $userid = $user->getId();
  $senhaInput = md5($data->senha);
  $senhaInput = substr($senhaInput, 5);
  if (($senhaNova = $data->senhaNova) !== '') {
    $senhaNova = md5($data->senhaNova);
    $senhaNova = substr($senhaNova, 5);
    $data->senha = $senhaNova;
  } else {
    $data->senha = $senhaInput;
  }
  unset($data->senhaNova);
  
  $sql = "SELECT senha FROM hp_users WHERE id = $userid";
  $query = $db->prepare($sql);
  $query->execute();
  $senha = $query->fetch(PDO::FETCH_ASSOC)['senha'];
  

  if ($senha !== $senhaInput) {
    return print(json_encode([ 'error' => 'Você forneceu uma senha inválida.' ]));
  }

  $sql = "UPDATE hp_users SET ";

  foreach ($data as $key => $val) {
    if (is_string($val) && $val = trim($val))
      $sql .= "$key = '$val' ";
    else if (is_string($val) && empty($val))
      $sql .= "$key = ''";
    else
      $sql .= "$key = $val ";
    end($data);
    if (key($data) != $key) 
      $sql .= ', ';
  }

  $sql .= "WHERE id = $userid";
  $query = $db->prepare($sql);
  try {
    $query->execute();
  } catch (PDOException $e) {
    return print(json_encode([ 'error' => $e->errorInfo, 'query' => $sql]));
  }

  $expires = new DateTime('now');
  $expires->setTimezone(new DateTimeZone('America/Sao_Paulo'));

  header('Set-Cookie: hp_pages_auth=deleted; path=/; HttpOnly; expires='.$expires->format(DateTime::COOKIE));
  echo json_encode([ 'success' => 'Dados da conta atualizados com sucesso.' ]);
?>