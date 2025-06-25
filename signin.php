<?php 
// include header file
include ('include/header.php');

if(isset($_POST['SignIn'])){
	// Email Input Check
	if(isset($_POST['email']) && !empty($_POST['email'])){
		$email = $_POST['email'];
	} else {
		$emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Please fill the Email field</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
	}

	// Password Input Check
	if(isset($_POST['password']) && !empty($_POST['password'])){
		$password = $_POST['password'];
		$password = md5($password);
	} else {
		$passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Please fill the Password field</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
	}
}

// Login Query
if(isset($email) && isset($password)){
	$sql = "SELECT * FROM donor WHERE password='$password' AND email='$email'";
	$result = mysqli_query($connection, $sql);

	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['save_life_date'] = $row['save_life_date'];

			// Redirect to welcome page
			header('Location: user/index.php');
			exit();
		}
	} else {
		$submitError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Sorry! No Record Found. Please Enter Valid Email or Password</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
	}
}
?>

<style>
	/* New Styles */
	body, html {
		height: 100%;
		margin: 0;
		font-family: 'Poppins', sans-serif;
		background: url('https://www.lompocvmc.com/images/blog/heart/organ-donation.jpg') no-repeat center center fixed;
		background-size: cover;
	}

	.size {
		min-height: 0px;
		padding: 80px 0 80px 0;
	}

	h1, h3 {
		color: #dc3545;
		font-weight: bold;
		text-align: center;
	}

	.form-group {
		text-align: left;
	}

	.red-bar {
		width: 25%;
		height: 3px;
		background-color: #dc3545;
		margin: 10px auto 20px auto;
		border-radius: 5px;
	}

	.form-container {
		background: rgba(255, 255, 255, 0.95);
		border-radius: 10px;
		padding: 40px 30px;
		box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		border: 1px solid rgba(255, 255, 255, 0.18);
		animation: fadeIn 1s ease-in-out;
	}

	.btn-danger {
		width: 100%;
		border-radius: 25px;
		font-weight: bold;
		background-color: #3498db;
		border: none;
		transition: 0.3s;
	}

	.btn-danger:hover {
		background-color: #2980b9;
	}

	.alert {
		margin-top: 10px;
	}

	@keyframes fadeIn {
		from { opacity: 0; transform: translateY(-20px); }
		to { opacity: 1; transform: translateY(0); }
	}

	.welcome-message {
		text-align: center;
		font-size: 28px;
		color:rgb(232, 17, 17);
		font-weight: bold;
		background: rgba(0, 0, 0, 0.4);
		padding: 20px;
		border-radius: 15px;
		margin-bottom: 30px;
		animation: fadeIn 1s ease-in-out;
	}
</style>

<div class="container size">
	<div class="row">
		<div class="col-md-6 offset-md-3">

			<div class="form-container">
				<h3>Sign In</h3>
				<hr class="red-bar">

				<?php if(isset($submitError)) echo $submitError; ?>

				<form action="" method="post">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" class="form-control" placeholder="Enter your email" required>
						<?php if(isset($emailError)) echo $emailError; ?>
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" placeholder="Enter your password" required>
						<?php if(isset($passwordError)) echo $passwordError; ?>
						<small><a href="forgot_password.php">Forgot Password?</a></small>
					</div>

					<div class="form-group text-center">
						<button class="btn btn-danger btn-lg" type="submit" name="SignIn">Sign In</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>

<?php include 'include/footer.php'; ?>
