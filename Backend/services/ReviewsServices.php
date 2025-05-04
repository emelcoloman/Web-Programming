<?php
require_once 'BaseServices.php';
require_once __DIR__ . '/../dao/rest/ReviewsDao.php';

class ReviewsServices extends BaseServices {
    public function __construct() {
        parent::__construct(new ReviewsDao());
    }

    public function create($data) {
        if (empty($data['user_id']) || empty($data['product_id']) || empty($data['rating'])) {
            throw new Exception("User ID, Product ID, and Rating are required.");
        }

        if (!is_numeric($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
            throw new Exception("Rating must be a number between 1 and 5.");
        }

        if (isset($data['comment']) && strlen($data['comment']) > 500) {
            throw new Exception("Comment must be 500 characters or fewer.");
        }

        return parent::create($data);
    }
}
?>
