<?php
require_once 'BaseDao.php';

class ProductDao extends BaseDao {
    public function __construct() {
        parent::__construct('product');
    }

    public function createProduct($data) {
        return $this->insert($data);
    }

    public function getProductById($id) {
        return $this->getById($id);
    }

    public function getAllProducts() {
        return $this->getAll();
    }

    public function updateProduct($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteProduct($id) {
        return $this->delete($id);
    }
}
