<?php
  $obj = [ 'nome' => 'geefi', 'senha' => 123 ];
  $obj = json_decode(json_encode($obj));

  foreach ($obj as $key => $val) {
    echo "$key => $val<br>";
  }

  echo end($obj);
  echo key($obj);
?>