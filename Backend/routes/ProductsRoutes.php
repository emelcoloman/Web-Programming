<?php
require_once __DIR__ . '/../services/ProductService.php';

Flight::route('GET /products', function() {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $service = new ProductService();
    Flight::json($service->getAll());
});

Flight::route('GET /products/@id', function($id) {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $service = new ProductService();
    Flight::json($service->getById($id));
});

Flight::route('POST /products', function() {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new ProductService();
    Flight::json($service->create($data));
});

Flight::route('PUT /products/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new ProductService();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /products/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new ProductService();
    Flight::json($service->delete($id));
});
