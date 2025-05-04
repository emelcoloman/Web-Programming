<?php
require_once 'BaseServices.php';
require_once __DIR__ . '/../dao/rest/ProductsDao.php';

class ProductService extends BaseServices {
    public function __construct() {
        parent::__construct(new ProductDao());
    }

    public function create($data) {
        if (empty($data['name']) || $data['price'] < 0) {
            throw new Exception("Product name is required and price must be non-negative.");
        }

        return parent::create($data);
    }
}
?>
