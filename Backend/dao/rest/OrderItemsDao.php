<?php
require_once 'BaseDao.php';

class OrderItemDao extends BaseDao {
    public function __construct() {
        parent::__construct('order_item');
    }

    public function createOrderItem($data) {
        return $this->insert($data);
    }

    public function getOrderItemById($id) {
        return $this->getById($id);
    }

    public function getAllOrderItems() {
        return $this->getAll();
    }

    public function updateOrderItem($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteOrderItem($id) {
        return $this->delete($id);
    }
}
