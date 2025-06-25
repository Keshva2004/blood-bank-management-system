<?php
 include 'include/header.php';
  
  if(isset($_POST['submit'])){
    if(isset($_POST['term']) === true)
    {
        // Name Input Check
        if(isset($_POST['name']) && !empty($_POST['name']))
        {
            if(preg_match('/^[A-Za-z\s]+$/',$_POST['name']))
            {
                $name = $_POST['name'];
            } else {
                $nameError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Only lower and upper case and space characters are allowed</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        } else {
            $nameError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fill the name field</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        // Gender Input Check
        if(isset($_POST['gender']) && !empty($_POST['gender'])){
            $gender = $_POST['gender'];
        } else {
            $genderError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Select Your Gender</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        // Date Input Checks
        if(isset($_POST['day']) && !empty($_POST['day'])){
            $day = $_POST['day'];
        } else {
            $dayError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Select Your Day Input</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        if(isset($_POST['month']) && !empty($_POST['month'])){
            $month = $_POST['month'];
        } else {
            $monthError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Select Your Month Input</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        if(isset($_POST['year']) && !empty($_POST['year'])){
            $year = $_POST['year'];
        } else {
            $yearError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Select Your Year Input</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        // Blood Group Input Check
        if(isset($_POST['blood_group']) && !empty($_POST['blood_group'])){
            $blood_group = $_POST['blood_group'];
        } else {
            $blood_groupError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Select Your blood group input.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

       // City Input Check
if (isset($_POST['city']) && !empty(trim($_POST['city']))) {
    $cityInput = trim($_POST['city']);
    
    if (preg_match('/^[A-Za-z\s]+$/', $cityInput)) {
        $city = htmlspecialchars($cityInput); // Optional: sanitize
    } else {
        $cityError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Invalid city name:</strong> Only letters and spaces are allowed.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
} else {
    $cityError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Please fill the city field.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}


        // Contact Input Check
        if(isset($_POST['contact_no']) && !empty($_POST['contact_no']))
        {
            if(preg_match('/^(?:\+91[\-\s]?)?[6-9]\d{9}$/',$_POST['contact_no']))
            {
                $contact = $_POST['contact_no'];
            } else {
                $contactError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Contact should consist of exactly 10 digits.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        } else {
            $contactError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fill the contact field.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        // Password Input Check
        if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['c_password']) && !empty($_POST['c_password'])){
            if(preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $_POST['password'])){
                if($_POST['password'] == $_POST['c_password']){
                    $password = $_POST['password'];
                } else {
                    $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Passwords are not the same.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                }
            } else {
                $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>The password should consist of at least 6 characters.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        } else {
            $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fill both password fields</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        // Email Input Check
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if(preg_match($pattern, $_POST['email'])) {
                $check_email = $_POST['email'];
                $sql = "SELECT email FROM donor WHERE email='$check_email'";
                $result = mysqli_query($connection, $sql);
                if(mysqli_num_rows($result) > 0){
                    $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sorry, this email already exists.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                } else {
                    $email = $_POST['email'];
                }
            } else {
                $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please enter a valid email address.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        } else {
            $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fill the email field</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

		//insert data into database
         if(isset($name) && isset($blood_group) && isset($day)&& 
		 isset($month) && isset($year) && isset($email) && isset($city) && isset($password))
		 {
			$DonorDOB= $year."-".$month."-".$day;
           
            $save_life_date = 0; // Changed from date('Y-m-d') to 0
            $password = md5($password); 
			$sql = "INSERT INTO donor (name,gender,email,city,dob,contact_no,
			save_life_date,password,blood_group) VALUES ('$name','$gender','$email','$city','$DonorDOB','$contact',
			'$save_life_date','$password','$blood_group')";
			if(mysqli_query($connection,$sql)){
				// Get the newly inserted donor's ID
				$donor_id = mysqli_insert_id($connection);
				
				// Set session variables
				$_SESSION['donor_id'] = $donor_id;
				$_SESSION['name'] = $name;
				$_SESSION['email'] = $email;
				
				$submitSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Registration Successful! You can now view donor details.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
				
				// Redirect to donor page after successful registration
				header("Location: donor.php");
				exit();
			}
			else{
				$submitError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Sorry Yaar Data is not Inserted Try Again Buddy!!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
			}
		 }



    } else {
        $termError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please agree with our terms & conditions.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
  }
?>
<style>
    .size {
        min-height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                    url('https://png.pngtree.com/thumb_back/fh260/background/20220217/pngtree-red-simple-illustration-public-welfare-publicity-background-of-world-blood-donation-image_952530.jpg'); /* Add a relevant background image */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 60px 0;
    }
    .form-container {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-control {
        height: 45px;
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        padding: 0.375rem 1rem;
        transition: all 0.3s;
        background-color: rgba(255, 255, 255, 0.9);
    }
    .form-control:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
    }
    h1 {
        font-size: 3.5em;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        margin-bottom: 30px;
        color: #fff;
    }
    h3 {
        color: #2196F3;
        font-size: 2.2em;
        font-weight: 600;
        margin-bottom: 30px;
    }
    .custom-bar {
        height: 4px;
        width: 50px;
        background: #2196F3;
        margin: 20px auto;
        border-radius: 2px;
    }
    .btn-custom {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        border: none;
        height: 50px;
        border-radius: 25px;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 8px 15px rgba(33, 150, 243, 0.3);
        transition: all 0.3s;
        color: white;
    }
    .btn-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px rgba(33, 150, 243, 0.4);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .size {
            padding: 30px 15px;
        }
        h1 {
            font-size: 2.5em;
        }
        .form-container {
            padding: 20px;
        }
    }
</style>

<!-- Update the header section -->
<div class="container-fluid size">
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <h1>Save Lives Today</h1>
            <p class="lead text-white mb-4">Join our community of heroes. Every drop counts.</p>
            <hr class="custom-bar">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2 form-container">
            <h3 class="text-center">Become a Donor</h3>
            <hr class="custom-bar">
            <!-- Rest of your form remains the same -->
            <!-- Rest of your form remains the same -->
<div class="container size">
	<div class="row">
		<div class="col-md-6 offset-md-3 form-container">
					<h3 class="text-center">SignUp</h3>
					
					<hr class="red-bar">
					<?php if(isset($termError)) echo $termError; 
					      if(isset($submitSuccess)) echo $submitSuccess;
						  if(isset($submitError)) echo $submitError;
					?>
          <!-- Error Messages -->

				<form class="form-group" action="" method="post" novalidate="">
				<div class="form-group">
					<label for="fullname">Full Name</label>
					<input type="text" name="name" id="fullname" placeholder="Full Name" required pattern="[A-Za-z/\s]+" title="Only lower and upper case and space" class="form-control" value="<?php if(isset($name)) echo $name; ?>">
					<?php if(isset($nameError)) echo $nameError; ?>
				</div><!--full name-->
				<div class="form-group">
              		<label for="name">Blood Group</label><br>
					<select class="form-control demo-default" id="blood_group" name="blood_group" required>
						<option value="">---Select Your Blood Group---</option>
                        <?php if(isset($blood_group)) echo '<option selected="" value="'.$blood_group.'">'.$blood_group.'</option>' ; ?>
						<option  value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
					</select>
					<?php if(isset($blood_groupError)) echo $blood_groupError; ?>
           		</div><!--End form-group-->


				<div class="form-group">
				    <label for="gender">Gender</label><br>
		          	Male<input type="radio" name="gender" id="gender" value="Male" style="margin-left:10px; margin-right:10px;" checked>
                    Female<input type="radio" name="gender" id="gender" value="Female" style="margin-left:10px;" <?php if(isset($gender) && $gender == 'Female') echo "checked"; ?>>
                      <?php if(isset($genderError)) echo $genderError; ?>
				</div><!--gender-->
					


                <div class="form-inline">
    <label for="name">Date of Birth</label><br><br>

    <!-- Day Dropdown -->
    <select class="form-control demo-default" id="date" name="day" style="margin-bottom:10px;" required>
   <option value="">---Date---</option>
        <?php 
            if (isset($day)) echo '<option selected value="'.$day.'">'.$day.'</option>';
            for ($d = 1; $d <= 31; $d++) {
                $formattedDay = str_pad($d, 2, "0", STR_PAD_LEFT);
                echo "<option value=\"$formattedDay\">$formattedDay</option>";
            }
        ?>
    </select>

    <!-- Month Dropdown -->
    <select class="form-control demo-default" name="month" id="month" style="margin-bottom:10px;" required>
        <option value="">---Month---</option>
        <?php 
            $months = [
                "01" => "January", "02" => "February", "03" => "March", "04" => "April",
                "05" => "May", "06" => "June", "07" => "July", "08" => "August",
                "09" => "September", "10" => "October", "11" => "November", "12" => "December"
            ];

            if (isset($month)) echo '<option selected value="'.$month.'">'.$months[$month].'</option>';

            foreach ($months as $num => $name) {
                echo "<option value=\"$num\">$name</option>";
            }
        ?>
    </select>

    <!-- Year Dropdown -->
    <select class="form-control demo-default" id="year" name="year" style="margin-bottom:10px;" required>
        <option value="">---Year---</option>
        <?php 
            if (isset($year)) echo '<option selected value="'.$year.'">'.$year.'</option>';
            for ($y = 1957; $y <= 2005; $y++) {
                echo "<option value=\"$y\">$y</option>";
            }
        ?>
    </select>
</div><!-- End form-inline -->

<!-- Display validation errors if set -->
<?php if (isset($dayError)) echo $dayError; ?>
<?php if (isset($monthError)) echo $monthError; ?>
<?php if (isset($yearError)) echo $yearError; ?>



			<div class="form-group">
				<label for="fullname">Email</label>
				<input type="text" name="email" id="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please write correct email" class="form-control" value="<?php if(isset($email)) echo $email; ?>">
				<?php if(isset($emailError)) echo $emailError; ?>
			</div>
	


			<div class="form-group">
            	<label for="contact_no">Contact No</label>
            	<input type="text" name="contact_no"  placeholder="+91-********" class="form-control" required pattern="^\d{11}$" title="11 numeric characters only" maxlength="11" value="<?php if(isset($contact)) echo $contact; ?>">
            	<?php if(isset($contactError)) echo $contactError; ?>
			</div><!--End form-group-->


			<div class="form-group">
            	<label for="city">Location</label>
            	<select name="city" id="city" class="form-control demo-default" required>
	        	<option value="">-- Select --</option>
                <?php if(isset($city)) echo '<option selected="" value="'.$city.'">'.$city.'</option>' ; ?>
<optgroup title="A" label="&raquo; A"></optgroup>
<option value="Aambaliyasan">Aambaliyasan</option>
<option value="Agol">Agol</option>
<option value="Aithor">Aithor</option>
<option value="Akhaj">Akhaj</option>
<option value="Ambasan">Ambasan</option>

<optgroup title="B" label="&raquo; B"></optgroup>
<option value="Badarpur">Badarpur, Gujarat</option>
<option value="Bhandu">Bhandu</option>
<option value="Bhankhar">Bhankhar</option>
<option value="Bokarvada">Bokarvada</option>
<option value="Boriavi">Boriavi (Mehsana Taluka)</option>
<option value="Brahmanwada,Unjha">Brahmanwada, Unjha</option>

<optgroup title="C" label="&raquo; C"></optgroup>
<option value="Chansol">Chansol</option>

<optgroup title="D" label="&raquo; D"></optgroup>
<option value="Dabhad">Dabhad</option>
<option value="Dabhoda">Dabhoda, Mehsana</option>
<option value="Davol">Davol, Mehsana</option>
<option value="Deloli">Deloli</option>

<optgroup title="G" label="&raquo; G"></optgroup>
<option value="Gambhu">Gambhu</option>
<option value="Ghumasan">Ghumasan</option>
<option value="Gorisana">Gorisana</option>
<option value="Gozaria">Gozaria</option>

<optgroup title="J" label="&raquo; J"></optgroup>
<option value="Jetalvasana">Jetalvasana</option>

<optgroup title="K" label="&raquo; K"></optgroup>
<option value="Kesimpa">Kesimpa, Mehsana</option>
<option value="Kharod">Kharod, Gujarat</option>
<option value="Kherva">Kherva</option>
<option value="Kuda">Kuda, Mehsana</option>

<optgroup title="L" label="&raquo; L"></optgroup>
<option value="Ladol">Ladol, Gujarat</option>
<option value="Langhnaj">Langhnaj</option>

<optgroup title="M" label="&raquo; M"></optgroup>
<option value="Madhasana">Madhasana</option>
<option value="Mahiyal">Mahiyal</option>
<option value="Maktupur">Maktupur</option>
<option value="Malarpura">Malarpura</option>
<option value="Mandropur">Mandropur</option>
<option value="Modhera">Modhera</option>
<option value="Mota Kotarna">Mota Kotarna</option>

<optgroup title="N" label="&raquo; N"></optgroup>
<option value="Nava Sudasana">Nava Sudasana</option>

<optgroup title="P" label="&raquo; P"></optgroup>
<option value="Pilvai">Pilvai</option>

<optgroup title="R" label="&raquo; R"></optgroup>
<option value="Rahemanpur">Rahemanpur</option>

<optgroup title="S" label="&raquo; S"></optgroup>
<option value="Sadikpur, Kheralu">Sadikpur, Kheralu</option>
<option value="Sakari">Sakari, Mehsana</option>
<option value="Saldi">Saldi</option>
<option value="Samoja">Samoja</option>
<option value="Sangathala">Sangathala</option>
<option value="Satlasana">Satlasana</option>
<option value="Shahpur">Shahpur, Kheralu</option>
<option value="Suvariya">Suvariya</option>

<optgroup title="T" label="&raquo; T"></optgroup>
<option value="Thangana">Thangana, Mehsana</option>
<option value="Timba">Timba, Mahesana</option>
<option value="Tundav">Tundav</option>

<optgroup title="U" label="&raquo; U"></optgroup>
<option value="Ucharpi">Ucharpi</option>
<option value="Unad">Unad, Mehsana</option>
<option value="Unava">Unava</option>

<optgroup title="V" label="&raquo; V"></optgroup>
<option value="Vaghvadi">Vaghvadi, Mehsana</option>
<option value="Vakhtapur">Vakhtapur (Mahi Kantha)</option>
<option value="Vamaj">Vamaj</option>
<option value="Varetha">Varetha</option>
<option value="Vavdi">Vavdi, Mehsana</option>
<option value="Vithoda">Vithoda</option>
</select>
            	<?php if(isset($cityError)) echo $cityError; ?>
			</div><!--city end-->
			


            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" value="" placeholder="Password" class="form-control" required pattern=".{6,}">
            </div><!--End form-group-->

            <div class="form-group">
              <label for="password">Confirm Password</label>
              <input type="password" name="c_password" value="" placeholder="Confirm Password" class="form-control" required pattern=".{6,}">
			  <?php if(isset($passwordError)) echo $passwordError; ?>
			</div><!--End form-group-->
			


            <div class="form-inline">
              <input  type="checkbox" checked="" name="term" value="true" required style="margin-left:10px;">
              <span style="margin-left:10px;"><b>I am agree to donate my blood and show my Name, Contact Nos. and E-Mail in Blood donors List</b></span>
            </div><!--End form-group-->
			
					<div class="form-group">
						<button id="submit" name="submit" type="submit" class="btn btn-lg btn-danger center-aligned" style="margin-top: 20px;">SignUp</button>
					</div>
				</form>
		</div>
	</div>
</div>
<script>
    // Add smooth transitions to form fields
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Password strength indicator
    document.querySelector('input[name="password"]').addEventListener('input', function() {
        const strength = this.value.length;
        const strengthBar = document.createElement('div');
        strengthBar.className = 'progress-bar';
        strengthBar.style.width = `${Math.min(strength * 10, 100)}%`;
    });
</script>
<?php 
  //include footer file
  include ('include/footer.php');
?>