<?php
session_start();
require_once('include/config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Include header
include('include/header.php');

// Get and sanitize filter values
$search = mysqli_real_escape_string($connection, $_GET['search'] ?? '');
$status = mysqli_real_escape_string($connection, $_GET['status_filter'] ?? '');
$hospital = mysqli_real_escape_string($connection, $_GET['hospital_filter'] ?? '');

// Build the query with filters
$query = "SELECT r.*, h.name as hospital_name 
         FROM blood_requests r 
         LEFT JOIN hospitals h ON r.hospital_id = h.id 
         WHERE 1";

if (!empty($search)) {
    $query .= " AND (r.requester_name LIKE '%$search%' 
              OR r.blood_group LIKE '%$search%' 
              OR r.units LIKE '%$search%')";
}
if (!empty($status)) {
    $query .= " AND r.status = '$status'";
}
if (!empty($hospital)) {
    $query .= " AND h.name = '$hospital'";
}

$query .= " ORDER BY r.created_at DESC";
$result = mysqli_query($connection, $query);
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-clipboard-list me-2"></i>Blood Requests
        </h2>
        <form method="GET" class="d-flex gap-2" id="filterForm">
            <div class="input-group">
                <input type="text" name="search" id="searchInput" class="form-control" 
                       placeholder="Search requests..." value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <select class="form-select" name="status_filter" id="statusFilter">
                <option value="">All Status</option>
                <?php
                $statuses = ['pending', 'approved', 'rejected'];
                foreach ($statuses as $statusOption) {
                    $selected = $status === $statusOption ? 'selected' : '';
                    echo "<option value=\"$statusOption\" $selected>" . 
                         ucfirst($statusOption) . "</option>";
                }
                ?>
            </select>
            <select class="form-select" id="hospitalFilter">
                <option value="">All Hospitals</option>
                <?php
                $hospital_query = "SELECT DISTINCT name FROM hospitals WHERE location='Mehsana' ORDER BY name";
                $hospital_result = mysqli_query($connection, $hospital_query);
                while ($hospital = mysqli_fetch_assoc($hospital_result)) {
                    echo '<option value="' . htmlspecialchars($hospital['name']) . '">' . 
                         htmlspecialchars($hospital['name']) . '</option>';
                }
                ?>
            </select>
            <button type="reset" class="btn btn-outline-secondary" onclick="resetFilters()">
                <i class="fas fa-undo me-1"></i>Reset
            </button>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <?php if (mysqli_num_rows($result) > 0): ?>
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requester</th>
                            <th>Blood Group</th>
                            <th>Units</th>
                            <th>Hospital</th>
                            <th>Required Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="requestsTable">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $statusClass = '';
                            switch($row['status']) {
                                case 'pending':
                                    $statusClass = 'bg-warning';
                                    break;
                                case 'approved':
                                    $statusClass = 'bg-success';
                                    break;
                                case 'rejected':
                                    $statusClass = 'bg-danger';
                                    break;
                            }
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['requester_name']); ?></td>
                            <td>
                                <span class="badge bg-danger">
                                    <?php echo htmlspecialchars($row['blood_group']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($row['units']); ?></td>
                            <td><?php echo htmlspecialchars($row['hospital_name'] ?? $row['hospital']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                            <td>
                                <span class="badge <?php echo $statusClass; ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info me-1" onclick="viewRequest(<?php echo $row['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if($row['status'] == 'pending'): ?>
                                <button class="btn btn-sm btn-success me-1" onclick="updateStatus(<?php echo $row['id']; ?>, 'approved')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="updateStatus(<?php echo $row['id']; ?>, 'rejected')">
                                    <i class="fas fa-times"></i>
                                </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No requests found</h5>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function resetFilters() {
    window.location.href = 'requests.php';
}

// Loading Spinner Modal
<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="mb-0">Processing Request...</h5>
            </div>
        </div>
    </div>
</div>

const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));

function showLoading() {
    loadingModal.show();
}

function hideLoading() {
    loadingModal.hide();
}

// View request details
function viewRequest(id) {
    showLoading();
    fetch(`get_request_details.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            hideLoading();
            const details = document.getElementById('requestDetails');
            details.innerHTML = `
                <dl class="row mb-0">
                    <dt class="col-sm-4">Requester</dt>
                    <dd class="col-sm-8">${data.requester_name}</dd>
                    
                    <dt class="col-sm-4">Contact</dt>
                    <dd class="col-sm-8">${data.contact}</dd>
                    
                    <dt class="col-sm-4">Blood Group</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-danger">${data.blood_group}</span>
                    </dd>
                    
                    <dt class="col-sm-4">Units</dt>
                    <dd class="col-sm-8">${data.units}</dd>
                    
                    <dt class="col-sm-4">Hospital</dt>
                    <dd class="col-sm-8">${data.hospital}</dd>
                    
                    <dt class="col-sm-4">Required Date</dt>
                    <dd class="col-sm-8">${data.required_date}</dd>
                    
                    <dt class="col-sm-4">Reason</dt>
                    <dd class="col-sm-8">${data.reason}</dd>
                </dl>`;
            
            new bootstrap.Modal(document.getElementById('requestModal')).show();
        })
        .catch(error => {
            hideLoading();
            alert('Error loading request details');
        });
}

// Update request status
function updateStatus(id, status) {
    if (confirm('Are you sure you want to ' + status + ' this request?')) {
        showLoading();
        fetch('update_request_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}&status=${status}`
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating status');
            }
        })
        .catch(error => {
            hideLoading();
            alert('Error updating status');
        });
    }
}
</script>

<?php include('include/footer.php'); ?>
