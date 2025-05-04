<?php
require_once __DIR__ . '/../services/ProductsServices.php';

Flight::route('GET /products', function() {
    $service = new ProductService();
    Flight::json($service->getAll());
});

Flight::route('GET /products/@id', function($id) {
    $service = new ProductsServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /products', function() {
    $data = Flight::request()->data->getData();
    $service = new ProductsServices();
    Flight::json($service->add($data));
});

Flight::route('PUT /products/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new ProductsServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /products/@id', function($id) {
    $service = new ProductsServices();
    Flight::json($service->delete($id));
});
