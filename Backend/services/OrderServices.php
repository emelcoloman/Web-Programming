<?php
require_once 'BaseServices.php';
require_once __DIR__ . '/../dao/rest/OrdersDao.php';

class OrderServices extends BaseServices {
    public function __construct() {
        parent::__construct(new OrdersDao());
    }

    public function create($data) {
        if (empty($data['user_id']) || !is_numeric($data['user_id'])) {
            throw new Exception("A valid user_id is required.");
        }

        if ($data['total'] < 0) {
            throw new Exception("Order total cannot be negative.");
        }

        return parent::create($data);
    }
}
?>
