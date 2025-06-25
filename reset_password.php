<?php
include 'include/config.php';
include 'include/header.php';
?>

<style>
.reset-password-container {
    min-height: 100vh;
    background: linear-gradient(120deg, #f6f9fc 0%, #edf1f7 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
    background: linear-gradient(to right bottom, #ffffff, #fafbff);
    transition: all 0.3s ease;
    max-width: 450px;
    width: 100%;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(50, 50, 93, 0.15), 0 8px 20px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: linear-gradient(45deg,rgb(230, 71, 151),rgb(233, 84, 149));
    padding: 25px;
    border: none;
}

.card-header h4 {
    font-size: 26px;
    font-weight: 600;
    color: #ffffff;
    text-transform: none;
    letter-spacing: 0.5px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 30px;
    background: rgba(255, 255, 255, 0.9);
}

.form-group label {
    color: #4a5568;
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 10px;
}

.form-control {
    height: 50px;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    padding: 0 20px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #f8fafc;
}

.form-control:focus {
    border-color: #8E54E9;
    box-shadow: 0 0 0 3px rgba(142, 84, 233, 0.1);
    background: #ffffff;
}

.btn-danger {
    background: linear-gradient(45deg,rgb(230, 71, 137),rgb(233, 84, 166));
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    padding: 14px 30px;
    transition: all 0.3s ease;
    width: 100%;
    border: none;
    color: #ffffff;
    letter-spacing: 0.5px;
}

.btn-danger:hover {
    background: linear-gradient(45deg,rgb(194, 61, 134),rgb(204, 70, 108));
    transform: translateY(-2px);
    box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
}

.alert {
    border-radius: 12px;
    padding: 20px;
    background: linear-gradient(to right, #fff5f5, #fff0f0);
    border: none;
}

.alert-danger {
    color: #4a5568;
    border-left: 4px solid #8E54E9;
}

.alert h5 {
    color: #4776E6;
    font-weight: 600;
    margin-bottom: 10px;
}

.alert .btn-danger {
    margin-top: 15px;
    display: inline-block;
    width: auto;
}

.form-group {
    position: relative;
    margin-bottom: 25px;
}

/* Add animation for form elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group {
    animation: fadeInUp 0.5s ease-out forwards;
}
</style>

<div class="reset-password-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 text-center">Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['token'])) {
                            $token = mysqli_real_escape_string($connection, $_GET['token']);
                            $sql = "SELECT * FROM donor WHERE reset_token='$token'";
                            $result = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                ?>
                                <form action="update_password.php" method="post">
                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                    <div class="form-group mb-4">
                                        <label>New Password</label>
                                        <input type="password" name="new_password" class="form-control" 
                                               placeholder="Enter new password" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" 
                                               placeholder="Confirm new password" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Update Password</button>
                                </form>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-danger text-center">
                                    <h5>Invalid Reset Link</h5>
                                    <p>Please request a new password reset link.</p>
                                    <a href="forgot_password.php" class="btn btn-danger">Request New Link</a>
                                </div>
                                <?php
                            }
                        } else {
                            header("Location: forgot_password.php");
                            exit();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>
