<?php
require_once __DIR__ . '/../services/CategoriesServieces.php';

Flight::route('GET /categories', function() {
    $service = new CategoriesServices();
    Flight::json($service->getAll());
});

Flight::route('GET /categories/@id', function($id) {
    $service = new CategoriesServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /categories', function() {
    $data = Flight::request()->data->getData();
    $service = new CategoriesServices();
    Flight::json($service->add($data));
});

Flight::route('PUT /categories/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new CategoriesServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /categories/@id', function($id) {
    $service = new CategoriesServices();
    Flight::json($service->delete($id));
});
