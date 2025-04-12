<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'blooddonation');

// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if (mysqli_query($conn, $sql)) {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

// Create tables
function setupTables($conn) {
    // Users table
    $users = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        blood_type VARCHAR(5),
        address TEXT,
        phone VARCHAR(20),
        role ENUM('admin', 'donor', 'recipient') NOT NULL DEFAULT 'recipient',
        last_donation_date DATE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    // Blood inventory table
    $inventory = "CREATE TABLE IF NOT EXISTS blood_inventory (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        blood_type VARCHAR(5) NOT NULL,
        quantity_ml INT(11) NOT NULL,
        donation_date DATE NOT NULL,
        expiry_date DATE NOT NULL,
        donor_id INT(11),
        status ENUM('available', 'reserved', 'used') DEFAULT 'available',
        FOREIGN KEY (donor_id) REFERENCES users(id) ON DELETE SET NULL
    )";
    
    // Donation requests table
    $requests = "CREATE TABLE IF NOT EXISTS donation_requests (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        requester_id INT(11),
        blood_type VARCHAR(5) NOT NULL,
        quantity_ml INT(11) NOT NULL,
        urgency ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium',
        status ENUM('pending', 'fulfilled', 'cancelled') DEFAULT 'pending',
        request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        fulfillment_date TIMESTAMP NULL,
        notes TEXT,
        FOREIGN KEY (requester_id) REFERENCES users(id) ON DELETE SET NULL
    )";
    
    // Donation centers table
    $centers = "CREATE TABLE IF NOT EXISTS donation_centers (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        address TEXT NOT NULL,
        contact VARCHAR(20) NOT NULL,
        email VARCHAR(100),
        latitude DECIMAL(10,8),
        longitude DECIMAL(11,8),
        operating_hours TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    // Appointments table
    $appointments = "CREATE TABLE IF NOT EXISTS appointments (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        donor_id INT(11),
        center_id INT(11),
        appointment_date DATETIME NOT NULL,
        status ENUM('scheduled', 'completed', 'cancelled', 'no-show') DEFAULT 'scheduled',
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (donor_id) REFERENCES users(id) ON DELETE SET NULL,
        FOREIGN KEY (center_id) REFERENCES donation_centers(id) ON DELETE CASCADE
    )";
    
    // Execute queries
    mysqli_query($conn, $users);
    mysqli_query($conn, $inventory);
    mysqli_query($conn, $requests);
    mysqli_query($conn, $centers);
    mysqli_query($conn, $appointments);
}

// Setup tables
setupTables($conn);
?> 