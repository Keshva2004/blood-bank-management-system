<style>
.navbar {
    padding: 10px 20px;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
    padding: 10px 20px;
}

.nav-item {
    margin: 0 10px;
    position: relative;
}

.navbar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-link {
    transition: all 0.3s ease;
    padding: 8px 15px;
    position: relative;
}

.nav-link:hover {
    transform: scale(1.05);
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 50%;
    background-color: #ffffff;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 80%;
}

/* Remove these conflicting styles */
/* .nav-link:hover {
    text-decoration: underline;
}

.nav-link.active {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
} */

.notification-badge {
    position: absolute;
    top: 0;
    right: -5px;
    background: #ff4444;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.7rem;
}

@media (max-width: 991.98px) {
    .navbar-collapse {
        background: #dc3545;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 10px;
    }
}

.admin-login-btn {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 8px 16px;
    border-radius: 20px;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 10px;
}

.admin-login-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.admin-login-btn i {
    margin-right: 8px;
    font-size: 1.1em;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <!-- Logo/Title Section -->
        <a class="navbar-brand d-flex align-items-center" href="index.php" title="Blood Bank Admin Dashboard">
            <i class="fas fa-heartbeat me-2"></i>
            Blood Bank Admin
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav"
                aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="adminNav">
            <!-- Center Navigation Section -->
            <!-- Center Navigation Section -->
            <ul class="navbar-nav mx-auto gap-3">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" 
                       href="index.php" title="Go to Dashboard">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'donors.php' ? 'active' : ''; ?>" 
                       href="donors.php" title="Manage Donors">
                        <i class="fas fa-users me-2"></i>Donors
                        <span class="notification-badge" id="donorCount"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'requests.php' ? 'active' : ''; ?>" 
                       href="requests.php" title="View Blood Requests">
                        <i class="fas fa-clipboard-list me-2"></i>Requests
                        <span class="notification-badge" id="requestCount"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'inventory.php' ? 'active' : ''; ?>" 
                       href="inventory.php" title="Manage Blood Stock">
                        <i class="fas fa-warehouse me-2"></i>Blood Stock
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php" title="Back to Main Site">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </li>
            </ul>

            <!-- Right Section - User Controls -->
            <ul class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['admin_id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="admin_profile.php" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-2"></i>
                        <span><?php echo isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Admin'; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow">
                        <a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user me-2"></i>Profile
                        </a>
                        <a class="dropdown-item" href="#" id="settingsBtn">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light d-flex align-items-center" href="login.php">
                        <i class="fas fa-lock me-2"></i>Admin Login
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <style>
            /* Update the admin login button styles */
            .nav-link.btn-outline-light {
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-radius: 20px;
                padding: 6px 15px;
                margin-left: 10px;
                transition: all 0.3s ease;
            }

            .nav-link.btn-outline-light:hover {
                background: rgba(255, 255, 255, 0.1);
                border-color: #ffffff;
                transform: translateY(-1px);
            }

            .nav-link.btn-outline-light::after {
                display: none;
            }

            @media (max-width: 991.98px) {
                .nav-link.btn-outline-light {
                    margin: 10px 0;
                    justify-content: center;
                }
            }
            </style>
        </div>
    </div>
</nav>

<script>
// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.altKey) {
        switch(e.key) {
            case 'd': window.location.href = 'index.php'; break;    // Dashboard
            case 'n': window.location.href = 'donors.php'; break;   // doNors
            case 'r': window.location.href = 'requests.php'; break; // Requests
            case 'b': window.location.href = 'inventory.php'; break;// Blood stock
            case 'p': window.location.href = 'profile.php'; break;  // Profile
        }
    }
});

// Update notification badges
function updateNotificationBadges() {
    // Example: Update donor count
    fetch('get_counts.php')
        .then(response => response.json())
        .then(data => {
            if (data.newDonors > 0) {
                document.getElementById('donorCount').textContent = data.newDonors;
            }
            if (data.pendingRequests > 0) {
                document.getElementById('requestCount').textContent = data.pendingRequests;
            }
        });
}

// Update badges every 5 minutes
setInterval(updateNotificationBadges, 300000);

// Initial update
updateNotificationBadges();
</script>

<!-- Remove this entire section -->
<!--
<li class="nav-item">
<style>
.admin-login-btn {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 8px 16px;
    border-radius: 20px;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 10px;
}

.admin-login-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.admin-login-btn i {
    margin-right: 8px;
    font-size: 1.1em;
}
</style>

<div class="text-center">
    <a class="admin-login-btn" href="admin/login.php">
        <i class="fas fa-user-shield"></i>
        Admin Login
    </a>
</div>
</li>
-->

<!-- Add this instead, after the closing </nav> tag -->
<style>
.admin-login-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.admin-login-btn {
    display: inline-flex;
    align-items: center;
    background: rgba(220, 53, 69, 0.1);
    padding: 10px 20px;
    border-radius: 25px;
    color: #dc3545;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid #dc3545;
    font-weight: 500;
}

.admin-login-btn:hover {
    background: #dc3545;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
}

.admin-login-btn i {
    margin-right: 10px;
    font-size: 1.2em;
}
</style>

<div class="admin-login-container">
    <a class="admin-login-btn" href="admin/login.php">
        <i class="fas fa-user-shield"></i>
        Admin Login
    </a>
</div>
