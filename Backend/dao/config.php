<?php

class Config {
    public static function DB_NAME() {
        return self::get_env("DB_NAME", "webproject");
    }

    public static function DB_PORT() {
        return (int) self::get_env("DB_PORT", 3306);
    }

    public static function DB_USER() {
        return self::get_env("DB_USER", 'root');
    }

    public static function DB_PASSWORD() {
        return self::get_env("DB_PASSWORD", 'RobotMan12');
    }

    public static function DB_HOST() {
        return self::get_env("DB_HOST", 'localhost');
    }

    public static function JWT_SECRET() {
        return self::get_env("JWT_SECRET", 'a36f2feae774e26e6eea498f2bc66c33b37457c73f9fa99f7901789829cd19e99fdd8012be90f72f676c6feeba25ac56d6be5e264dc7602c8543fcfa35f0fa12');
    }

    private static function get_env($name, $default) {
        return (isset($_ENV[$name]) && trim($_ENV[$name]) !== '') ? $_ENV[$name] : $default;
    }
}

class Database {
    private static $connection = null;

    public static function connect() {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=" . Config::DB_HOST() . ";dbname=" . Config::DB_NAME() . ";port=" . Config::DB_PORT();
                self::$connection = new PDO(
                    $dsn,
                    Config::DB_USER(),
                    Config::DB_PASSWORD(),
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
        return Config::JWT_SECRET();
    }
}

?>
