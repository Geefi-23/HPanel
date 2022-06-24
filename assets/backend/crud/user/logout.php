<?php
  header('Access-Control-Allow-Headers: Content-Type, Set-Cookie');
  header('Access-Control-Allow-Origin: http://localhost:3000');
  header('Access-Control-Allow-Credentials: true');

  header('Set-Cookie: hp_pages_auth=deleted; path=/; expires='.-1);
  header('Location: /painel/login');
?>