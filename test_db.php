<?php
try {
    $pdo = new PDO('mysql:host=mysql;dbname=laravel', 'sail', 'password', [
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "SUCCESS: Connected to database\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
