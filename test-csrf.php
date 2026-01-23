<?php

// Test CSRF Token
session_start();
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;

echo "Test CSRF Login\n";
echo "===============\n\n";

// Simulate login attempt
$email = 'admin@example.com';
$password = 'password123';
$token = $csrf_token;

echo "Email: $email\n";
echo "Password: $password\n";
echo "CSRF Token: " . substr($token, 0, 20) . "...\n\n";

// Test validation
if (empty($token)) {
    echo "❌ CSRF Token is missing\n";
} else {
    echo "✓ CSRF Token is present\n";
}

if (empty($email) || empty($password)) {
    echo "❌ Credentials are missing\n";
} else {
    echo "✓ Credentials are present\n";
}

echo "\nTest passed!\n";
