<?php
// Connect to the database
include('include/config.php');

if (isset($_GET['city'], $_GET['blood_group'])) {
    $city = mysqli_real_escape_string($connection, $_GET['city']);
    $blood_group = mysqli_real_escape_string($connection, $_GET['blood_group']);
    
    $sql = "SELECT * FROM donor WHERE city='$city' AND blood_group='$blood_group'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="col-md-3">
                    <div class="donors_data">
                        <div class="donor-card">
                            <h3>' . $row['name'] . '</h3>
                            <div class="donor-info">
                                <p><i class="fa fa-map-marker"></i> ' . $row['city'] . '</p>
                                <p><i class="fa fa-tint"></i> ' . $row['blood_group'] . '</p>
                                <p><i class="fa fa-user"></i> ' . $row['gender'] . '</p>
                                <p><i class="fa fa-envelope"></i> ' . $row['email'] . '</p>
                                <p><i class="fa fa-phone"></i> ' . $row['contact_no'] . '</p>
                            </div>
                        </div>
                    </div>
                  </div>';
        }
    } else {
        echo '<div class="col-md-12">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> No donors found matching your criteria.
                </div>
              </div>';
    }
}
?>
