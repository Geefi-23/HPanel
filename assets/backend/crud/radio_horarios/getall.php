<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost/');
  header('Access-Control-Allow-Credentials: true');

  require '../../DataBase.php';

  $db = DataBase::getInstance();

  $sql = "SELECT id, DATE_FORMAT(comeca, '%H:%i'), DATE_FORMAT(termina, '%H:%i'), usuario FROM hp_radio_horarios";
  $query = $db->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($results);
?>