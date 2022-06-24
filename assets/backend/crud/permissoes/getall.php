<?php
  require '../../DataBase.php';

  $db = DataBase::getInstance();

  $sql = "SELECT * FROM hp_permissions";
  $query = $db->prepare($sql);
  $query->execute();

  $permissions = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($permissions);
?>