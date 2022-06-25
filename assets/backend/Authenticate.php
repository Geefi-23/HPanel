<?php
  require 'Token.php';

  function authenticate() {
    if (isset($_COOKIE['hp_pages_auth']) && Token::isValid($_COOKIE['hp_pages_auth']))
      return true;
    return false;
  }
?>