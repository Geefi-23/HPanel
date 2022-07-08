<?php
  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;

  $db = DataBase::getInstance();

  $sql = "SELECT * FROM hp_permissions";
  $query = $db->prepare($sql);
  $query->execute();

  $permissions = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($permissions);
?>