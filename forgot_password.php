<?php include 'include/header.php'; ?>

<style>
.forgot-password-container {
    min-height: 80vh;
    display: flex;
    align-items: center;
    background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), 
                url('assets/img/background.jpg') center/cover;
}

.form-container {
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.form-container h3 {
    color: #dc3545;
    text-align: center;
    font-weight: 600;
    margin-bottom: 20px;
}

.red-bar {
    border: 2px solid #dc3545;
    width: 70px;
    margin: 20px auto;
}

.form-group label {
    color: #495057;
    font-weight: 500;
    margin-bottom: 10px;
}

.form-control {
    height: 50px;
    border-radius: 25px;
    padding: 0 20px;
    border: 2px solid #ced4da;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
}

.btn-danger {
    padding: 12px 40px;
    border-radius: 25px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220,53,69,0.3);
}

.back-to-login {
    text-align: center;
    margin-top: 20px;
}

.back-to-login a {
    color: #dc3545;
    text-decoration: none;
    font-weight: 500;
}

.back-to-login a:hover {
    text-decoration: underline;
}
</style>

<div class="forgot-password-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="form-container">
                    <h3>Forgot Password?</h3>
                    <hr class="red-bar">
                    <p class="text-center text-muted mb-4">Enter your email address and we'll send you a link to reset your password.</p>
                    
                    <form method="post" action="send_reset_link.php">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" 
                                   placeholder="Enter your registered email" required>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-danger btn-lg">
                                Send Reset Link
                            </button>
                        </div>
                    </form>
                    
                    <div class="back-to-login">
                        <a href="signin.php">← Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>
