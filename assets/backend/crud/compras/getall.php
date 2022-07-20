<?php
  require __DIR__ . '/../../../../vendor/autoload.php';

  use Utils\DataBase;

  $db = DataBase::getInstance();

  $sql = "SELECT id, nome_compravel AS `item`, discord_usuario AS `discord`, codigo, resolvido FROM hp_compras";
  $query = $db->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($results);
?>