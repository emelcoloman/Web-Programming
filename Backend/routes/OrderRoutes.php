<?php
require_once __DIR__ . '/../services/OrderServices.php';

Flight::route('GET /orders', function() {
    $service = new OrderServices();
    Flight::json($service->getAll());
});

Flight::route('GET /orders/@id', function($id) {
    $service = new OrderServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /orders', function() {
    $data = Flight::request()->data->getData();
    $service = new OrderServices();
    Flight::json($service->add($data));
});

Flight::route('PUT /orders/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new OrderServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /orders/@id', function($id) {
    $service = new OrderServices();
    Flight::json($service->delete($id));
});
