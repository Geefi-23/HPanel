<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://179.221.124.17/');
  header('Access-Control-Allow-Credentials: true');

  require '../../HabbletDataBase.php';
  require '../../DataBase.php';
  require '../../Authenticate.php';

  if (!authenticate())
    return print(json_encode([ 'error' => 'Você não está autorizado.' ]));

  $data = json_decode(file_get_contents('php://input'));

  $db = HabbletDataBase::getInstance();

  $titulo = $data->titulo;
  $resumo = $data->resumo;
  $texto = $data->texto;
  $status = $data->status;
  $url = $data->url;

  $sql = 'UPDATE noticias SET titulo = ?, resumo = ?, texto = ?, status = ? WHERE url = ?';
  $query = $db->prepare($sql);
  $query->bindValue(1, $titulo);
  $query->bindValue(2, $resumo);
  $query->bindValue(3, $texto);
  $query->bindValue(4, $status);
  $query->bindValue(5, $url);
  try {
    $query->execute();
  } catch (PDOException $e) {
    print(json_encode([ 'error' => 'Não foi possível atualizar esta notícia', 'details' => $e->errorInfo ]));
  }

  echo json_encode([ 'success' => 'Noticia atualizada com sucesso' ]);
?>