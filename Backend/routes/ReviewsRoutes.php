<?php
require_once __DIR__ . '/../services/ReviewsServices.php';

Flight::route('GET /reviews', function() {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $service = new ReviewsServices();
    Flight::json($service->getAll());
});

Flight::route('GET /reviews/@id', function($id) {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $service = new ReviewsServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /reviews', function() {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $data = Flight::request()->data->getData();
    $service = new ReviewsServices();
    Flight::json($service->add($data));
});

Flight::route('PUT /reviews/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new ReviewsServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /reviews/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new ReviewsServices();
    Flight::json($service->delete($id));
});
