<?php
  require_once '../../DataBase.php';
  //include_once '../utils/Permissions.php';

  class User extends Permissions {
    private $id;
    private $nome;
    private $cargo;
    private $permissions = [];

    private $database;

    function __construct($userData) {
      $this->id = $userData['id'];
      $this->nome = $userData['nome'];
      $this->cargo = $userData['cargo'];
      $this->cargo_id = 0;
      $this->database = DataBase::getInstance();

      // getting permissions
      $sql = "SELECT permission AS `id` FROM hp_cargos_permissions WHERE cargo = ?";
      $query = $this->database->prepare($sql);
      $query->bindValue(1, $userData['cargo'], PDO::PARAM_INT);
      $query->execute();

      $this->permissions = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasPermission(int $permission) {
      foreach ($this->permissions as $p) {
        if (intval($p['id']) == $permission)
          return true;
      }
      return false;
    }

    public function getNome() {
      return $this->nome;
    }

    public function getPermissions() {
      return $this->permissions;
    }

    public function getCargo() {
      return $this->cargo;
    }
    
  }
?>