<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Include required files
include '../include/config.php';
include 'include/header.php';

// Add error handling for database queries
try {
    // Get statistics
    $donors_query = "SELECT COUNT(*) as total FROM donor";
    $donors_result = mysqli_query($connection, $donors_query);
    if (!$donors_result) {
        throw new Exception("Donors query failed: " . mysqli_error($connection));
    }
    $donors_count = mysqli_fetch_assoc($donors_result)['total'];

    $users_query = "SELECT COUNT(*) as total FROM users";
    $users_result = mysqli_query($connection, $users_query);
    if (!$users_result) {
        throw new Exception("Users query failed: " . mysqli_error($connection));
    }
    $users_count = mysqli_fetch_assoc($users_result)['total'];

    $requests_query = "SELECT COUNT(*) as total FROM blood_requests WHERE status='pending'";
    $requests_result = mysqli_query($connection, $requests_query);
    if (!$requests_result) {
        throw new Exception("Requests query failed: " . mysqli_error($connection));
    }
    $pending_requests = mysqli_fetch_assoc($requests_result)['total'];

} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    $donors_count = $users_count = $pending_requests = 0;
}
?>

<!-- Add CSS for animations and hover effects -->
<style>
.card {
    transition: transform 0.3s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.stat-icon {
    font-size: 2.5rem;
    transition: transform 0.3s;
}
.card:hover .stat-icon {
    transform: scale(1.2);
}
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,0.05);
    cursor: pointer;
}
.refresh-btn {
    transition: transform 0.3s;
}
.refresh-btn:hover {
    transform: rotate(180deg);
}
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
        <button class="btn btn-outline-primary refresh-btn" onclick="refreshStats()">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>
    
    <div class="row" id="stats-container">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Donors</h6>
                            <h2 class="mb-0" id="donors-count"><?php echo $donors_count; ?></h2>
                        </div>
                        <i class="fas fa-users stat-icon"></i>
                    </div>
                </div>
                <a href="donors.php" class="card-footer text-white bg-primary-dark d-block">
                    View Details <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        
        <!-- Similar updates for users and requests cards -->
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Users</h6>
                            <h2 class="mb-0"><?php echo $users_count; ?></h2>
                        </div>
                        <i class="fas fa-user-friends fa-2x"></i>
                    </div>
                </div>
                <a href="users.php" class="card-footer text-white bg-success-dark d-block">
                    View Details <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Pending Requests</h6>
                            <h2 class="mb-0"><?php echo $pending_requests; ?></h2>
                        </div>
                        <i class="fas fa-clipboard-list fa-2x"></i>
                    </div>
                </div>
                <a href="requests.php" class="card-footer text-white bg-warning-dark d-block">
                    View Details <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Recent Donors Table with Search -->
    <div class="card mt-4">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Donors</h5>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" id="searchDonor" placeholder="Search donors..." onkeyup="searchDonors()">
                    <select class="form-control" id="bloodGroupFilter" onchange="filterDonors()">
                        <option value="">All Blood Groups</option>
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
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="donors-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>City</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM donor ORDER BY id DESC LIMIT 5";
                        $result = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['blood_group']."</td>";
                            echo "<td>".$row['city']."</td>";
                            echo "<td>".(isset($row['created_at']) ? $row['created_at'] : 'N/A')."</td>";
                            echo "<td><button onclick='viewDonorDetails(".$row['id'].")' class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add this modal structure before the closing </div> of container -->
<div class="modal fade" id="donorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="donorDetails">
                <!-- Donor details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Update the view button in the table row -->
<?php
// Replace the existing view button line with:
echo "<td><button onclick='viewDonorDetails(".$row['id'].")' class='btn btn-sm btn-info'><i class='fas fa-eye'></i></button></td>";
?>

<!-- Add this JavaScript function before the closing </script> tag -->
<script>
function viewDonorDetails(id) {
    fetch(`get_user_details.php?id=${id}&role=donor`)
        .then(response => response.json())
        .then(data => {
            if (data.success === false) {
                alert(data.message);
                return;
            }
            document.getElementById('donorDetails').innerHTML = `
                <dl class="row mb-0">
                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8">${data.name}</dd>
                    
                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">${data.email}</dd>
                    
                    <dt class="col-sm-4">Blood Group</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-danger">${data.blood_group}</span>
                    </dd>
                    
                    <dt class="col-sm-4">Contact</dt>
                    <dd class="col-sm-8">${data.contact}</dd>
                    
                    <dt class="col-sm-4">City</dt>
                    <dd class="col-sm-8">${data.address || 'N/A'}</dd>
                    
                    <dt class="col-sm-4">Gender</dt>
                    <dd class="col-sm-8">${data.gender || 'N/A'}</dd>
                    
                    <dt class="col-sm-4">Last Donation</dt>
                    <dd class="col-sm-8">${data.save_life_date || 'Never'}</dd>
                </dl>`;
            
            const donorModal = new bootstrap.Modal(document.getElementById('donorModal'));
            donorModal.show();
        })
        .catch(error => alert('Error loading donor details'));
}
</script>

<?php include 'include/footer.php'; ?>