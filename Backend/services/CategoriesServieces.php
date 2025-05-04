<?php
require_once 'BaseServices.php';
require_once __DIR__ . '/../dao/rest/CategoriesDao.php';

class CategoriesServices extends BaseServices {
    public function __construct() {
        parent::__construct(new CategoryDao());
    }

    public function create($data) {
        if (empty($data['name'])) {
            throw new Exception("Category name is required.");
        }

        $existing = $this->dao->getByName($data['name']);
        if ($existing) {
            throw new Exception("Category already exists.");
        }

        return parent::create($data);
    }
}
?>
