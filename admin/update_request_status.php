<?php
require_once('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $query = "UPDATE blood_requests SET status = '$status' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    
    echo json_encode(['success' => $result]);
}