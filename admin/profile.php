<?php
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include '../include/config.php';
include 'include/header.php';

$admin_id = $_SESSION['admin_id'];
$success_message = $error_message = '';

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        
        $update_query = "UPDATE admin SET name='$name', email='$email' WHERE id=$admin_id";
        if (mysqli_query($connection, $update_query)) {
            $_SESSION['admin_name'] = $name;
            $success_message = 'Profile updated successfully!';
        } else {
            $error_message = 'Failed to update profile.';
        }
    }
    
    if (isset($_POST['change_password'])) {
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        
        $check_query = "SELECT * FROM admin WHERE id=$admin_id AND password='$current_password'";
        $check_result = mysqli_query($connection, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            if ($new_password === $confirm_password) {
                $update_query = "UPDATE admin SET password='$new_password' WHERE id=$admin_id";
                if (mysqli_query($connection, $update_query)) {
                    $success_message = 'Password changed successfully!';
                } else {
                    $error_message = 'Failed to change password.';
                }
            } else {
                $error_message = 'New passwords do not match.';
            }
        } else {
            $error_message = 'Current password is incorrect.';
        }
    }
}

// Get admin details
$query = "SELECT * FROM admin WHERE id=$admin_id";
$result = mysqli_query($connection, $query);
$admin = mysqli_fetch_assoc($result);
?>

<div class="container mt-4">
    <?php if ($success_message): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    
    <?php if ($error_message): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Update Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $admin['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $admin['email']; ?>" required>
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>