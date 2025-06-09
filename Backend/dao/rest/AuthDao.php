<?php
require_once __DIR__ . '/BaseDao.php';


class AuthDao extends BaseDao {
   protected $table_name;


   public function __construct() {
       $this->table_name = "users";
       parent::__construct($this->table_name);
   }


   public function get_user_by_email($email) {
    $sql = "SELECT id, name, email, password, role, permissions FROM users WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && $user['permissions']) {
        $user['permissions'] = json_decode($user['permissions'], true);
    } else {
        $user['permissions'] = [];
    }

    return $user;
}
}
