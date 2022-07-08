<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost/');
  header('Access-Control-Allow-Credentials: true');

  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;

  $db = DataBase::getInstance();

  $sql = "SELECT CASE WHEN hm.id IS NULL THEN h.id ELSE hm.id END AS id, 
        DATE_FORMAT(h.comeca, '%H:%i') AS `comeca`, DATE_FORMAT(h.termina, '%H:%i') AS `termina`, 
        CASE WHEN hm.usuario IS NULL THEN '' ELSE hm.usuario END AS usuario
        FROM hp_radio_horarios AS h
        LEFT JOIN hp_radio_horarios_marcados AS hm
        ON hm.horario = h.id";
  
  if (isset($_GET['date']) && $date = $_GET['date']) {
    $sql .= " AND hm.dia = '$date'";
  }

  $query = $db->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($results);
?>