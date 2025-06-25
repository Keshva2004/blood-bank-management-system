<?php
session_start();
require_once('include/config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if (isset($_GET['id']) && isset($_GET['role'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $role = mysqli_real_escape_string($connection, $_GET['role']);

    // Different queries for donor and regular user
    if ($role === 'donor') {
        $query = "SELECT id, name, email, blood_group, contact_no as contact, city as address, 'active' as status 
                 FROM donor WHERE id = ?";
    } else {
        $query = "SELECT id, name, email, blood_group, contact, address, status 
                 FROM users WHERE id = ?";
    }

    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>