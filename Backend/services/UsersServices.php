<?php
require_once 'BaseServices.php';
require_once __DIR__ . '/../dao/rest/UsersDao.php';


class UsersServices extends BaseServices {
    public function __construct() {
        parent::__construct(new UsersDao());
    }

    public function create($data) {
        if (empty($data['email']) || empty($data['password'])) {
            throw new Exception("Email and password are required.");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if ($this->dao->getUserByEmail($data['email'])) {
            throw new Exception("Email already in use.");
        }

        return parent::create($data);
    }
}
?>
