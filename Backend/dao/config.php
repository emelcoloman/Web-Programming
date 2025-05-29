<?php

class Database {
    private static $host = 'localhost';
    private static $dbName = 'webproject';
    private static $username = 'root';
    private static $password = 'RobotMan12';
    private static $connection = null;
 
 
    public static function connect() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host .";dbname=" . self::$dbName,
                    self::$username,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function JWT_SECRET() {
       return 'a36f2feae774e26e6eea498f2bc66c33b37457c73f9fa99f7901789829cd19e99fdd8012be90f72f676c6feeba25ac56d6be5e264dc7602c8543fcfa35f0fa12';
   }

 }
 ?>
 