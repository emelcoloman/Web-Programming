<?php
require_once 'BaseDao.php';

class OrdersDao extends BaseDao {
    public function __construct() {
        parent::__construct('orders');
    }

    public function createOrder($data) {
        return $this->insert($data);
    }

    public function getOrderById($id) {
        return $this->getById($id);
    }

    public function getAllOrders() {
        return $this->getAll();
    }

    public function updateOrder($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteOrder($id) {
        return $this->delete($id);
    }
}
