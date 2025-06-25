<?php 

include 'include/header.php';
include 'include/sidebar.php';

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
        // Name Input Check
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            if (preg_match('/^[A-Za-z\s]+$/', $_POST['name'])) {
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
        if (isset($_POST['gender']) && !empty($_POST['gender'])) {
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
        if (isset($_POST['day']) && !empty($_POST['day'])) {
            $day = $_POST['day'];
        } else {
            $dayError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Select Your Day Input</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        if (isset($_POST['month']) && !empty($_POST['month'])) {
            $month = $_POST['month'];
        } else {
            $monthError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Select Your Month Input</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        if (isset($_POST['year']) && !empty($_POST['year'])) {
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
        if (isset($_POST['blood_group']) && !empty($_POST['blood_group'])) {
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
        if (isset($_POST['contact_no']) && !empty($_POST['contact_no'])) {
            if (preg_match('/^(?:\+91[\-\s]?)?[6-9]\d{9}$/', $_POST['contact_no'])) {
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


        // Email Input Check
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (preg_match($pattern, $_POST['email'])) {
                $check_email = $_POST['email'];
                $sql = "SELECT email FROM donor WHERE email='$check_email'";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
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
        if (
            isset($name) && isset($blood_group) && isset($day) &&
            isset($month) && isset($year) && isset($email) && isset($city)
        ) {
            $DonorDOB = $year . "-" . $month . "-" . $day;

            $save_life_date = date('Y-m-d'); // Set current date

            $sql = "UPDATE donor SET name='$name',gender='$gender',email='$email',city='$city',dob='$DonorDOB',contact_no='$contact',
			blood_group='$blood_group' WHERE id=" . $_SESSION['user_id'];


            if (mysqli_query($connection, $sql)) {
         $updateSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Updated.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
?>

                <!-- // 	$submitSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                // <strong>Data Inserted Successfully</strong>
                // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                // <span aria-hidden="true">&times;</span>
                // </button>
                // </div>'; -->

                <script>
                    function myFunction() {
                        location.reload();
                    }
                </script>

            <?php
            } else {
                $updateError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Sorry Yaar Data is not updated Try Again Buddy!!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
            }
        }
    } // End of Submit If

    $sql = "SELECT * FROM donor WHERE id=" . $_SESSION['user_id'];
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $userID = $row['id'];
            $name = $row['name'];
            $blood_group = $row['blood_group'];
            $gender = $row['gender'];
            $email = $row['email'];
            $contact = $row['contact_no'];
            $city = $row['city'];

            $dob = $row['dob'];

            //[0] 1997-[1]-03-[2]20

            $date = explode("-", $dob);

            $dbPassword = $row['password'];
        }
    }
    if (isset($_POST['update_pass'])) {

        // Password Input Check
        if (
            isset($_POST['old_password']) && !empty($_POST['old_password'])
            && isset($_POST['c_password']) && !empty($_POST['c_password'])
            && isset($_POST['new_password']) && !empty($_POST['new_password'])
        ) {

            $oldpasswprd = md5($_POST['old_password']);

            if ($oldpasswprd == $dbPassword) {

                if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $_POST['new_password'])) {
                    if ($_POST['new_password'] == $_POST['c_password']) {
                        $password = md5($_POST['new_password']);
                        // Update password in database
                        $update_sql = "UPDATE donor SET password='$password' WHERE id=" . $_SESSION['user_id'];
                        if (mysqli_query($connection, $update_sql)) {
                            $passwordSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Password updated successfully.</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                        } else {
                            $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Failed to update password. Please try again.</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                        }
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
                    <strong>The password should consist of at least 8 characters, including upper, lower, digit, and special character.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                }
            } else {
                $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please enter valid current password.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
            }
        } else {
            $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fill all password fields</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
        if(isset($password))
        {
                    $sql = "UPDATE donor SET password='$password' WHERE id='$userID'" ;

        if(mysqli_query($connection,$sql)){
              $updatePasswordSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Password Updated.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
           ?>
            <script>
                    function myFunction() {
                        location.reload();
                    }
                </script>

            <?php

        }else{
            $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Sorry Yaar Data is not Inserted Try Again Buddy!!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
        }
        }
    }
    if(isset($_POST['delete_account']))
    {
        if(isset($_POST['account_password']) && !empty($_POST['account_password'])){
            $account_password = md5($_POST['account_password']);
            if($account_password == $dbPassword){
        $showForm = '
        
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Are you sure to delete your Account?</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <form target="" method="post">
        <br>
        <input type="hidden" name="userID" value="'.$_SESSION['user_id'].'">
        <button type="submit" name="updateSave" class="btn btn-danger">Yes</button>

        <button type="button" class="btn btn-info" data-dismiss="alert">
            <span aria-hidden="true">Oops! No </span>
        </button>
    </form>
</div>

        ';
            }else{
                 $deleteAccountError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Please Enter valid password</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
            }


        }
        else{
             $deleteAccountError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Please ENter your password</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
        }
    }
         if(isset($_POST['userID'])){

        $userID = $_POST['userID'];
        $sql="DELETE FROM donor WHERE id=".$userID;
            if(mysqli_query($connection,$sql)){
                 header("Location: logout.php");

        }else{
            $deletesubmitError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Account Not deleted</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
        }
         }

include 'include/sidebar.php';
?>

    <style>
        .form-group {
            text-align: left;
        }

        .form-container {

            padding: 20px 10px 20px 30px;

        }
    </style>
    <div class="container" style="padding: 60px 0;">
        <div class="row">

            <div class=" card col-md-6 offset-md-3">
                <div class="panel panel-default" style="padding: 20px;">

                    <!-- Error Messages -->
                    <?php if(isset($showForm)) echo $showForm; ?>
                    <?php if (isset($updateError)) echo $updateError; ?>
                    <?php if (isset($nameError)) echo $nameError; ?>
                    <?php if (isset($blood_groupError)) echo $blood_groupError; ?>
                    <?php if (isset($genderError)) echo $genderError; ?>
                    <?php if (isset($dayError)) echo $dayError; ?>
                    <?php if (isset($monthError)) echo $monthError; ?>
                    <?php if (isset($yearError)) echo $yearError; ?>
                    <?php if (isset($emailError)) echo $emailError; ?>
                    <?php if (isset($cityError)) echo $cityError; ?>
                    <?php if (isset($contactError)) echo $contactError; ?>
                    <?php if (isset($passwordSuccess)) echo $passwordSuccess; ?>
                    <?php if (isset($updateSuccess)) echo $updateSuccess; ?>
                    <?php if(isset($deletesubmitError)) echo $deletesubmitError;?>

                    <form class="form-group" action="" method="post" novalidate="">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="name" id="fullname" placeholder="Full Name" required pattern="[A-Za-z/\s]+" title="Only lower and upper case and space" class="form-control" value="<?php if (isset($name)) echo $name; ?>">
                        </div><!--full name-->
                        <div class="form-group">
                            <label for="name">Blood Group</label><br>
                            <select class="form-control demo-default" id="blood_group" name="blood_group" required>
                                <option value="">---Select Your Blood Group---</option>
                                <?php if (isset($blood_group)) echo '<option selected="" value="' . $blood_group . '">' . $blood_group . '</option>'; ?>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div><!--End form-group-->


                        <div class="form-group">
                            <label for="gender">Gender</label><br>
                            Male<input type="radio" name="gender" id="gender" value="Male" style="margin-left:10px; margin-right:10px;" <?php if (!isset($gender) || $gender == 'Male') echo "checked"; ?>>
                            Female<input type="radio" name="gender" id="gender" value="Female" style="margin-left:10px;" <?php if (isset($gender) && $gender == 'Female') echo "checked"; ?>>
                        </div><!--gender-->




                        <div class="form-inline">
                            <label for="name">Date of Birth</label><br><br>

                            <!-- Day Dropdown -->
                            <select class="form-control demo-default" id="date" name="day" style="margin-bottom:10px;" required>
                                <option value="">---Date---</option>
                                <?php
                                if (isset($date['2'])) echo '<option selected value="' . $date['2'] . '">' . $date['2'] . '</option>';
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

                                if (isset($date['1'])) echo '<option selected value="' . $date['1'] . '">' . $date['1'] . '</option>';

                                foreach ($months as $num => $name) {
                                    echo "<option value=\"$num\">$name</option>";
                                }
                                ?>
                            </select>

                            <!-- Year Dropdown -->
                            <select class="form-control demo-default" id="year" name="year" style="margin-bottom:10px;" required>
                                <option value="">---Year---</option>
                                <?php
                                if (isset($date['0'])) echo '<option selected value="' . $date['0'] . '">' . $date['0'] . '</option>';
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
                            <input type="text" name="email" id="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please write correct email" class="form-control" value="<?php if (isset($email)) echo $email; ?>">
                        </div>



                        <div class="form-group">
                            <label for="contact_no">Contact No</label>
                            <input type="text" name="contact_no" placeholder="+91-********" class="form-control" required pattern="^\d{11}$" title="11 numeric characters only" maxlength="11" value="<?php if (isset($contact)) echo $contact; ?>">
                        </div><!--End form-group-->


                        <div class="form-group">
                            <label for="city">Location</label>
                            <select name="city" id="city" class="form-control demo-default" required>
                                <option value="">-- Select --</option>
                                <?php if (isset($city)) echo '<option selected="" value="' . $city . '">' . $city . '</option>'; ?>
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
                        </div><!--city end-->


                        <div class="form-group">
                            <button id="submit" name="submit" type="submit" class="btn btn-lg btn-danger center-aligned" style="margin-top: 20px;">Update</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="card col-md-6 offset-md-3">
                <div class="panel panel-default" style="padding: 20px;">


                    <!-- Messages -->

                    <form action="" method="post" class="form-group form-container" >
                        <?php if (isset($passwordError)) echo $passwordError;
                        if (isset($updatePasswordSuccess)) echo $updatePasswordSuccess;
                         ?>
                        <div class="form-group">
                            <label for="oldpassword">Current Password</label>
                            <input type="password" required name="old_password" placeholder="Current Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="newpassword">New Password</label>
                            <input type="password" required name="new_password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="c_password">Confirm Password</label>
                            <input type="password" required name="c_password" placeholder="Confirm Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-danger center-aligned" type="submit" name="update_pass">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card col-md-6 offset-md-3">

                <!-- Display Message -->
                <?php if(isset($deleteAccountError)) echo $deleteAccountError;
                
                ?>
                <div class="panel panel-default" style="padding: 20px;">
                    <form action="" method="post" class="form-group form-container" >

                        <div class="form-group">
                            <label for="oldpassword">Password</label>
                            <input type="password" required name="account_password" placeholder="Current Password" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-lg btn-danger center-aligned" type="submit" name="delete_account">Delete Account</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

<?php
} else {
    header("Location: ../index.php");
}
include 'include/footer.php';
?>

