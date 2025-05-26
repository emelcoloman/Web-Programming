<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Run autoloader to load all dependencies

require 'routes/UsersRoutes.php';
require 'routes/ProductsRoutes.php';
require 'routes/CategoriesRoutes.php';
require 'routes/OrderRoutes.php';
require 'routes/OrderItemsRoutes.php';
require 'routes/ReviewsRoutes.php';
require 'services/BaseServices.php';
require 'services/AuthServices.php';
require 'middleware/AuthMiddleware.php';

Flight::register('baseServices', 'BaseServices');
Flight::register('auth_services', "AuthServices");
Flight::register('auth_middleware', "AuthMiddleware");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::route('/*', function() {
   if(
       strpos(Flight::request()->url, '/auth/login') === 0 ||
       strpos(Flight::request()->url, '/auth/register') === 0
   ) {
       return TRUE;
   } else {
       try {
        $authHeader = Flight::request()->getHeader("Authorization");

        if (!$authHeader || !str_starts_with($authHeader, "Bearer ")) {
            Flight::halt(401, "Invalid or missing Authorization header");
        }

        $token = str_replace("Bearer ", "", $authHeader);

        $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

        Flight::set('user', $decoded->user);
        Flight::set('jwt_token', $token);

        return true;
    } catch (\Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
   }
});


require_once __DIR__ . '/routes/AuthRoutes.php';




Flight::route('/', function() {  // Define route and function to handle request
   echo 'Hello world!';
});

Flight::start();  // Start FlightPHP