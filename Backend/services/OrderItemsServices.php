<?php
require_once 'BaseServices.php';
require_once __DIR__ . '/../dao/rest/OrderItemsDao.php';

class OrderItemsServices extends BaseServices {
    public function __construct() {
        parent::__construct(new OrderItemDao());
    }

    public function create($data) {
        if (empty($data['order_id']) || empty($data['product_id'])) {
            throw new Exception("Order ID and Product ID are required.");
        }

        if ($data['quantity'] <= 0) {
            throw new Exception("Quantity must be at least 1.");
        }

        return parent::create($data);
    }
}
?>
