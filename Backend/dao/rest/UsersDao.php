<?php
require_once 'BaseDao.php';

class UsersDao extends BaseDao {
    public function __construct() {
        parent::__construct('users');
    }

    public function createUser($data) {
        return $this->insert($data);
    }

    public function getUserById($id) {
        return $this->getById($id);
    }

    public function getAllUsers() {
        return $this->getAll();
    }

    public function updateUser($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }

    
}