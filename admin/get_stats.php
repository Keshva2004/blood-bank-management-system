<?php
session_start();
if(!isset($_SESSION['admin_id'])) {
    exit(json_encode(['error' => 'Unauthorized']));
}

include '../include/config.php';

$stats = [
    'donors' => 0,
    'users' => 0,
    'pending' => 0
];

$donors_query = "SELECT COUNT(*) as total FROM donor";
$donors_result = mysqli_query($connection, $donors_query);
$stats['donors'] = mysqli_fetch_assoc($donors_result)['total'];

$users_query = "SELECT COUNT(*) as total FROM users";
$users_result = mysqli_query($connection, $users_query);
$stats['users'] = mysqli_fetch_assoc($users_result)['total'];

$requests_query = "SELECT COUNT(*) as total FROM blood_requests WHERE status='pending'";
$requests_result = mysqli_query($connection, $requests_query);
$stats['pending'] = mysqli_fetch_assoc($requests_result)['total'];

header('Content-Type: application/json');
echo json_encode($stats);
?>