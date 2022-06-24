<?php
  
  require '../../DataBase.php';

  $db = DataBase::getInstance();

  $sql = "SELECT * FROM hp_cargos";
  $query = $db->prepare($sql);
  $query->execute();

  $cargos = $query->fetchAll(PDO::FETCH_ASSOC);

  $sql = "SELECT cp.cargo, p.id, p.nome FROM hp_cargos_permissions AS `cp`
  INNER JOIN hp_permissions AS `p`
  ON cp.permission = p.id";
  $query = $db->prepare($sql);
  $query->execute();

  $permissions = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode([ "cargos" => $cargos, "permissions" => $permissions ]);
?>