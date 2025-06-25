<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include 'include/config.php';

$admin_id = $_SESSION['admin_id'];
$success_message = $error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        
        // Update profile
        $sql = "UPDATE admin SET name = ?, email = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $admin_id);
        
        if ($stmt->execute()) {
            $_SESSION['admin_name'] = $name;
            $success_message = 'Profile updated successfully!';
        } else {
            $error_message = 'Failed to update profile.';
        }
    } elseif (isset($_POST['change_password'])) {
        $current_password = md5($_POST['current_password']);
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        if ($new_password !== $confirm_password) {
            $error_message = 'New passwords do not match.';
        } else {
            // Verify current password
            $verify_sql = "SELECT id FROM admin WHERE id = ? AND password = ?";
            $verify_stmt = $connection->prepare($verify_sql);
            $verify_stmt->bind_param("is", $admin_id, $current_password);
            $verify_stmt->execute();
            $result = $verify_stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Update password
                $new_password_hash = md5($new_password);
                $update_sql = "UPDATE admin SET password = ? WHERE id = ?";
                $update_stmt = $connection->prepare($update_sql);
                $update_stmt->bind_param("si", $new_password_hash, $admin_id);
                
                if ($update_stmt->execute()) {
                    $success_message = 'Password changed successfully!';
                } else {
                    $error_message = 'Failed to change password.';
                }
            } else {
                $error_message = 'Current password is incorrect.';
            }
        }
    }
}

// Fetch admin details
$sql = "SELECT id, name, email FROM admin WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if (!$admin) {
    die("Error: Admin not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: url('images/blood-donation-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            min-height: 100vh;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(248, 249, 250, 0.9);
            z-index: -1;
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
            margin-bottom: 2rem;
        }
        .navbar {
            background: rgba(220, 53, 69, 0.95) !important;
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-heartbeat"></i> Blood Bank Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donors.php"><i class="fas fa-users"></i> Donors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="requests.php"><i class="fas fa-clipboard-list"></i> Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blood_stock.php"><i class="fas fa-box"></i> Blood Stock</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin_profile.php"><i class="fas fa-user"></i> Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <?php if ($success_message): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if ($error_message): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Update Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($admin['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-danger">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                        <a href="admin_profile.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-key me-2"></i>Change Password</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" name="change_password" class="btn btn-danger">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>