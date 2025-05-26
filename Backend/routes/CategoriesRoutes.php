<?php
require_once __DIR__ . '/../services/CategoriesServieces.php';

Flight::route('GET /categories', function() {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $service = new CategoriesServices();
    Flight::json($service->getAll());
});

Flight::route('GET /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $service = new CategoriesServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /categories', function() {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new CategoriesServices();
    Flight::json($service->add($data));
});

Flight::route('PUT /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new CategoriesServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new CategoriesServices();
    Flight::json($service->delete($id));
});
