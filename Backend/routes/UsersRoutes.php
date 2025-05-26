<?php
require_once __DIR__ . '/../services/UsersServices.php';

Flight::route('GET /users', function() {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new UsersServices();
    Flight::json($service->getAll());
});

Flight::route('GET /users/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new UsersServices();
    Flight::json($service->getById($id));
});

Flight::route('POST /users', function() {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new UsersServices();
    Flight::json($service->create($data));
});

Flight::route('PUT /users/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new UsersServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /users/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new UsersServices();
    Flight::json($service->delete($id));
});
