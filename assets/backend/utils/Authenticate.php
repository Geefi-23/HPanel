<?php
  namespace Utils;

  require __DIR__ . '/../../../vendor/autoload.php';

  use Utils\DataBase;
  use Utils\Token;
  use Entities\User;

  class Authenticate {
    private function __construct(){}

    public static function authenticate() {
      if (isset($_COOKIE['hp_pages_auth']) && Token::isValid($_COOKIE['hp_pages_auth'])) {
        $db = DataBase::getInstance();

        $id = Token::decode($_COOKIE['hp_pages_auth'])[1]->sub;
        $sql = "SELECT id, nome, cargo, ultimo_login, ultimo_ip FROM hp_users WHERE id = $id";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$result) 
          return false;

        $user = new User($result);
        return $user;
      }
      return false;
    }
  }
  
?>