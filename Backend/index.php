<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Run autoloader to load all dependencies

require 'routes/UsersRoutes.php';
require 'routes/ProductsRoutes.php';
require 'routes/CategoriesRoutes.php';
require 'routes/OrderRoutes.php';
require 'routes/OrderItemsRoutes.php';
require 'routes/ReviewsRoutes.php';

Flight::route('/', function() {  // Define route and function to handle request
   echo 'Hello world!';
});

Flight::start();  // Start FlightPHP