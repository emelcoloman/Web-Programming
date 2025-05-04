<?php
require_once __DIR__ . '/../services/ReviewsServices.php';

Flight::route('GET /reviews', function() {
    $service = new ReviewsServices();
    Flight::json($service->getAll());
});

Flight::route('GET /reviews/@id', function($id) {
    $service = new ReviewsServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /reviews', function() {
    $data = Flight::request()->data->getData();
    $service = new ReviewsServices();
    Flight::json($service->add($data));
});

Flight::route('PUT /reviews/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new ReviewsServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /reviews/@id', function($id) {
    $service = new ReviewsServices();
    Flight::json($service->delete($id));
});
