<?php
include 'include/config.php';

if(isset($_GET['city']) && isset($_GET['blood_group'])) {
    $city = mysqli_real_escape_string($connection, $_GET['city']);
    $blood_group = mysqli_real_escape_string($connection, $_GET['blood_group']);
    
    $sql = "SELECT * FROM donor WHERE city='$city' AND blood_group='$blood_group'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row['save_life_date'] == '0') {
                echo '<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
                    <div class="donor-card">
                        <h3 class="name">'.$row['name'].'</h3>
                        <div class="donor-info">
                            <p><i class="fa fa-map-marker"></i> '.$row['city'].'</p>
                            <p><i class="fa fa-tint"></i> '.$row['blood_group'].'</p>
                            <p><i class="fa fa-user"></i> '.$row['gender'].'</p>
                            <p><i class="fa fa-envelope"></i> '.$row['email'].'</p>
                            <p><i class="fa fa-phone"></i> '.$row['contact_no'].'</p>
                        </div>
                    </div>
                </div>';
            } else {
                echo '<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
                    <div class="donor-card donated">
                        <h3 class="name">'.$row['name'].'</h3>
                        <div class="donor-info">
                            <p><i class="fa fa-map-marker"></i> '.$row['city'].'</p>
                            <p><i class="fa fa-tint"></i> '.$row['blood_group'].'</p>
                            <p><i class="fa fa-user"></i> '.$row['gender'].'</p>
                            <div class="donated-badge">
                                <i class="fa fa-check-circle"></i> Recently Donated
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    } else {
        echo '<div class="alert alert-info text-center">No donors found matching your criteria.</div>';
    }
}
?>