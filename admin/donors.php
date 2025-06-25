<?php
session_start();
if (!isset($_SESSION['admin_id'])) {  // Updated session check
    header("Location: login.php");
    exit;
}

include 'include/header.php';

include 'include/config.php';  // Updated to use config.php instead of db.php

// Handle search/filter
$where = "1=1";
if (isset($_GET['blood_group']) && !empty($_GET['blood_group'])) {
    $blood_group = mysqli_real_escape_string($connection, $_GET['blood_group']);  // Updated to use $connection
    $where .= " AND blood_group = '$blood_group'";
}
if (isset($_GET['city']) && !empty($_GET['city'])) {
    $city = mysqli_real_escape_string($connection, $_GET['city']);  // Updated to use $connection
    $where .= " AND city LIKE '%$city%'";
}

// Pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// Get total records for pagination
$total_query = "SELECT COUNT(*) as count FROM donor WHERE $where";  // Updated table name to donor
$total_result = mysqli_query($connection, $total_query);  // Updated to use $connection
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['count'];
$total_pages = ceil($total_records / $per_page);

// Get donors with pagination
// Update the main query
$query = "SELECT id, name, email, blood_group, gender, dob, contact_no, address, city, save_life_date FROM donor WHERE $where LIMIT $start, $per_page";

$result = mysqli_query($connection, $query);

// Add error handling for database queries
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Add this after the query to debug
if (mysqli_num_rows($result) > 0) {
    $sample_row = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM donor LIMIT 1"));
    echo "<!-- Available fields: " . implode(", ", array_keys($sample_row)) . " -->";
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Donor Management</h2>
        <div class="text-end">
            <span class="badge bg-primary">Total Donors: <?php echo $total_records; ?></span>
        </div>
    </div>

    <!-- Search/Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <select name="blood_group" class="form-select">
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="city" class="form-control" placeholder="Search by City">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="donors.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Donors Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <!-- Remove the Actions column from the table header -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Last Donation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo isset($row['id']) ? htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                <td><?php echo isset($row['name']) ? htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                <td>
                                    <span class="badge bg-info">
                                        <?php echo isset($row['blood_group']) ? htmlspecialchars($row['blood_group'], ENT_QUOTES, 'UTF-8') : ''; ?>
                                    </span>
                                </td>
                                <td><?php echo isset($row['city']) ? htmlspecialchars($row['city'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                <td><?php echo isset($row['contact_no']) ? htmlspecialchars($row['contact_no'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                <td>
                                    <?php 
                                    echo isset($row['save_life_date']) && $row['save_life_date'] ? 
                                        htmlspecialchars(date('Y-m-d', strtotime($row['save_life_date'])), ENT_QUOTES, 'UTF-8') : 
                                        'Never';
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>