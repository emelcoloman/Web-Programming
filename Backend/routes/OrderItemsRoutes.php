<?php
require_once __DIR__ . '/../services/OrderItemsServices.php';

Flight::route('GET /order-items', function() {
    $service = new OrderItemsServices();
    Flight::json($service->getAll());
});

Flight::route('GET /order-items/@id', function($id) {
    $service = new OrderItemsServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /order-items', function() {
    $data = Flight::request()->data->getData();
    $service = new OrderItemsServices();
    Flight::json($service->add($data));
});

Flight::route('PUT /order-items/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new OrderItemsServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /order-items/@id', function($id) {
    $service = new OrderItemsServices();
    Flight::json($service->delete($id));
});
