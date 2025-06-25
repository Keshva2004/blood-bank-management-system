<?php
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include '../include/config.php';
include 'include/header.php';

// Handle inventory updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blood_group = mysqli_real_escape_string($connection, $_POST['blood_group']);
    $units = (int)$_POST['units'];
    $action = $_POST['action'];
    
    $current_query = "SELECT units FROM blood_inventory WHERE blood_group='$blood_group'";
    $current_result = mysqli_query($connection, $current_query);
    
    if (mysqli_num_rows($current_result) > 0) {
        $current_units = mysqli_fetch_assoc($current_result)['units'];
        $new_units = ($action === 'add') ? $current_units + $units : $current_units - $units;
        $new_units = max(0, $new_units); // Prevent negative values
        
        $update_query = "UPDATE blood_inventory SET units=$new_units WHERE blood_group='$blood_group'";
        mysqli_query($connection, $update_query);
    } else {
        $insert_query = "INSERT INTO blood_inventory (blood_group, units) VALUES ('$blood_group', $units)";
        mysqli_query($connection, $insert_query);
    }
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Blood Inventory Management</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#updateInventoryModal">
            <i class="fas fa-plus"></i> Update Inventory
        </button>
    </div>

    <div class="row">
        <?php
        $blood_groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        foreach ($blood_groups as $group) {
            $query = "SELECT units FROM blood_inventory WHERE blood_group='$group'";
            $result = mysqli_query($connection, $query);
            $units = (mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result)['units'] : 0;
            
            $status_class = ($units < 5) ? 'danger' : (($units < 10) ? 'warning' : 'success');
            ?>
            <div class="col-md-3 mb-4">
                <div class="card border-<?php echo $status_class; ?>">
                    <div class="card-body text-center">
                        <h3 class="display-4"><?php echo $group; ?></h3>
                        <p class="lead"><?php echo $units; ?> units</p>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-<?php echo $status_class; ?>" 
                                 role="progressbar" 
                                 style="width: <?php echo min(($units/20)*100, 100); ?>%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<!-- Update Inventory Modal -->
<div class="modal fade" id="updateInventoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Blood Inventory</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Blood Group</label>
                        <select name="blood_group" class="form-control" required>
                            <?php
                            foreach ($blood_groups as $group) {
                                echo "<option value='$group'>$group</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Units</label>
                        <input type="number" name="units" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Action</label>
                        <select name="action" class="form-control" required>
                            <option value="add">Add Units</option>
                            <option value="remove">Remove Units</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>