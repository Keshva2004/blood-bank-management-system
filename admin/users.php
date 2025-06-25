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

// Get users list
$query = "SELECT u.id, u.name, u.email, 
    COALESCE(u.blood_group, 'N/A') as blood_group, 
    COALESCE(u.contact, 'N/A') as contact, 
    COALESCE(u.status, 'active') as status,
    COALESCE(u.role, 'user') as role,
    u.created_at as sort_date
FROM users u
UNION
SELECT d.id, d.name, d.email, d.blood_group, 
    COALESCE(d.contact_no, 'N/A') as contact, 
    'active' as status, 
    'donor' as role, d.save_life_date as sort_date
FROM donor d
ORDER BY sort_date DESC";
$result = mysqli_query($connection, $query);
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-users me-2"></i>Users Management
        </h2>
        <div class="d-flex gap-2">
            <input type="text" id="searchInput" class="form-control" placeholder="Search users...">
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <?php if (mysqli_num_rows($result) > 0): ?>
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Blood Group</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable">
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <span class="badge bg-danger">
                                    <?php echo htmlspecialchars($row['blood_group']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($row['contact']); ?></td>
                            <td>
                                <span class="badge <?php echo $row['status'] == 'active' ? 'bg-success' : 'bg-danger'; ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?php echo $row['role'] == 'donor' ? 'bg-primary' : 'bg-secondary'; ?>">
                                    <?php echo ucfirst($row['role']); ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info me-1" onclick="viewUser(<?php echo $row['id']; ?>, '<?php echo $row['role']; ?>')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning me-1" onclick="toggleStatus(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $row['id']; ?>, '<?php echo $row['role']; ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No users found</h5>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- View User Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="userDetails">
                <!-- User details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#usersTable tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// View user details
function viewUser(id, role) {
    fetch(`get_user_details.php?id=${id}&role=${role}`)
        .then(response => response.json())
        .then(data => {
            if (data.success === false) {
                alert(data.message);
                return;
            }
            document.getElementById('userDetails').innerHTML = `
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
                    
                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8">${data.address || 'N/A'}</dd>
                    
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        <span class="badge ${data.status === 'active' ? 'bg-success' : 'bg-danger'}'>
                            ${data.status.charAt(0).toUpperCase() + data.status.slice(1)}
                        </span>
                    </dd>
                </dl>`;
            
            const userModal = new bootstrap.Modal(document.getElementById('userModal'));
            userModal.show();
        })
        .catch(error => alert('Error loading user details'));
}

// Delete user function
function deleteUser(id, role) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        fetch('delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}&role=${role}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Error deleting user');
            }
        })
        .catch(error => alert('Error deleting user'));
    }
}
</script>

<?php include('include/footer.php'); ?>