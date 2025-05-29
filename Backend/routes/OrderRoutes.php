<?php
require_once __DIR__ . '/../services/OrderServices.php';

Flight::route('GET /orders', function() {
    $user = Flight::get('user');
    $service = new OrderServices();

    if ($user->role === 'ADMIN') {
        Flight::auth_middleware()->authorizeRole('ADMIN');
        Flight::json($service->getAll());
    } else {
        Flight::auth_middleware()->authorizeRole('USER');
        Flight::json($service->dao->getOrdersByUserId($user->id));
    }
});

Flight::route('GET /orders/@id', function($id) {
    $user = Flight::get('user');
    $service = new OrderServices();
    $order = $service->getById($id);

    if (!$order) {
        Flight::halt(404, "Order not found");
    }

    if ($user->role === 'ADMIN' || ($user->role === 'USER' && $order['user_id'] == $user->id)) {
        Flight::json($order);
    } else {
        Flight::halt(403, "Access denied");
    }
});

Flight::route('POST /orders', function() {
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);
    $user = Flight::get('user');

    $data = Flight::request()->data->getData();
    if ($user->role === 'USER') {
        $data['user_id'] = $user->id;
    }

    $service = new OrderServices();
    Flight::json($service->create($data));
});

Flight::route('PUT /orders/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new OrderServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /orders/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new OrderServices();
    Flight::json($service->delete($id));
});
