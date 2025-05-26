<?php
require_once __DIR__ . '/../services/OrderItemsServices.php';

Flight::route('GET /order-items', function() {
    $user = Flight::get('user');
    $service = new OrderItemsServices();

    if ($user->role === 'ADMIN') {
        Flight::auth_middleware()->authorizeRole('ADMIN');
        Flight::json($service->getAll());
    } else {
        Flight::auth_middleware()->authorizeRole('USER');
        Flight::json($service->dao->getItemsByUserId($user->id));
    }
});

Flight::route('GET /order-items/@id', function($id) {
    $user = Flight::get('user');
    $service = new OrderItemsServices();
    $item = $service->getById($id);

    if (!$item) {
        Flight::halt(404, "Order item not found");
    }

    if ($user->role === 'ADMIN' || $item['user_id'] == $user->id) {
        Flight::json($item);
    } else {
        Flight::halt(403, "Access denied");
    }
});

Flight::route('POST /order-items', function() {
    $user = Flight::get('user');
    Flight::auth_middleware()->authorizeAny(['ADMIN', 'USER']);

    $data = Flight::request()->data->getData();

    if ($user->role === 'USER') {
        $orderId = $data['order_id'];
        $order = (new OrderServices())->getById($orderId);
        if (!$order || $order['user_id'] != $user->id) {
            Flight::halt(403, "You cannot add items to this order.");
        }
    }

    $service = new OrderItemsServices();
    Flight::json($service->create($data));
});

Flight::route('PUT /order-items/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $data = Flight::request()->data->getData();
    $service = new OrderItemsServices();
    Flight::json($service->update($id, $data));
});

Flight::route('DELETE /order-items/@id', function($id) {
    Flight::auth_middleware()->authorizeRole('ADMIN');
    $service = new OrderItemsServices();
    Flight::json($service->delete($id));
});
