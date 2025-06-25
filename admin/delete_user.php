
<?php
session_start();
require_once('include/config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $role = mysqli_real_escape_string($connection, $_POST['role']);

    // Determine which table to delete from based on role
    $table = ($role === 'donor') ? 'donor' : 'users';
    
    $query = "DELETE FROM $table WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>