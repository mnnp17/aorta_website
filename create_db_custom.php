<?php
try {
    $dsn = "mysql:host=127.0.0.1;port=3307";
    $username = "root";
    $password = ""; // Assuming empty based on previous context, update if needed

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE DATABASE IF NOT EXISTS aorta_db");
    echo "Database 'aorta_db' created successfully (or already exists).";
} catch (PDOException $e) {
    echo "Error creating database: " . $e->getMessage();
}
