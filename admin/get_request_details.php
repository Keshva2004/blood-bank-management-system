<?php
session_start();
require_once('include/config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized access']);
    exit();
}

// Initialize response array
$response = ['success' => false, 'data' => null, 'error' => null];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    try {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT br.*, 
            CONCAT(d.name, ' (', d.blood_group, ')') as donor_name,
            h.name as hospital_name
            FROM blood_requests br
            LEFT JOIN donor d ON br.donor_id = d.id
            LEFT JOIN hospital h ON br.hospital_id = h.id
            WHERE br.id = ?");
        
        $stmt->bind_param('i', $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $response['data'] = $result->fetch_assoc();
            $response['success'] = true;
        } else {
            $response['error'] = 'Request not found';
            http_response_code(404);
        }
        
        $stmt->close();
    } catch (Exception $e) {
        $response['error'] = 'Database error occurred';
        http_response_code(500);
    }
} else {
    $response['error'] = 'Invalid request ID';
    http_response_code(400);
}

// Set JSON header and output response
header('Content-Type: application/json');
echo json_encode($response);