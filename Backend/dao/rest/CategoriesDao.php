<?php
require_once 'BaseDao.php';

class CategoryDao extends BaseDao {
    public function __construct() {
        parent::__construct('category');
    }

    public function createCategory($data) {
        return $this->insert($data);
    }

    public function getCategoryById($id) {
        return $this->getById($id);
    }

    public function getAllCategories() {
        return $this->getAll();
    }

    public function updateCategory($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteCategory($id) {
        return $this->delete($id);
    }
}
