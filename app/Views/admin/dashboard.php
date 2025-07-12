<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Dashboard</h1>
                <p>Welcome back, Admin! Here's what's happening today.</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search anything...">
                </div>
                <div class="user-profile">
                    <div class="user-avatar">JD</div>
                    <div class="user-info">
                        <h6>John Doe</h6>
                        <p>Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Total Users</p>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <h2 class="stat-value">12,543</h2>
                <p class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +15.3% from last month
                </p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Revenue</p>
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <h2 class="stat-value">$45,210</h2>
                <p class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +8.2% from last month
                </p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Orders</p>
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
                <h2 class="stat-value">1,234</h2>
                <p class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> -2.1% from last month
                </p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Products</p>
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <h2 class="stat-value">856</h2>
                <p class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +12.5% from last month
                </p>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Orders -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Recent Orders</h3>
                    <a href="#" class="card-action">View All</a>
                </div>
                <div class="table-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#12345</td>
                                <td>John Smith</td>
                                <td>Laptop Dell XPS</td>
                                <td>$1,299</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-edit">Edit</button>
                                        <button class="btn-action btn-delete">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#12346</td>
                                <td>Jane Doe</td>
                                <td>iPhone 14 Pro</td>
                                <td>$999</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-edit">Edit</button>
                                        <button class="btn-action btn-delete">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#12347</td>
                                <td>Mike Johnson</td>
                                <td>Samsung Galaxy S23</td>
                                <td>$799</td>
                                <td><span class="status-badge status-inactive">Cancelled</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-edit">Edit</button>
                                        <button class="btn-action btn-delete">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#12348</td>
                                <td>Sarah Wilson</td>
                                <td>MacBook Pro M2</td>
                                <td>$2,499</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-edit">Edit</button>
                                        <button class="btn-action btn-delete">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Recent Activity</h3>
                    <a href="#" class="card-action">View All</a>
                </div>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-avatar">JS</div>
                        <div class="activity-content">
                            <h6>John Smith placed an order</h6>
                            <p>Dell XPS Laptop - $1,299</p>
                        </div>
                        <div class="activity-time">2 min ago</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-avatar">JD</div>
                        <div class="activity-content">
                            <h6>Jane Doe updated profile</h6>
                            <p>Changed shipping address</p>
                        </div>
                        <div class="activity-time">15 min ago</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-avatar">MJ</div>
                        <div class="activity-content">
                            <h6>Mike Johnson cancelled order</h6>
                            <p>Samsung Galaxy S23 - $799</p>
                        </div>
                        <div class="activity-time">1 hour ago</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-avatar">SW</div>
                        <div class="activity-content">
                            <h6>Sarah Wilson registered</h6>
                            <p>New user account created</p>
                        </div>
                        <div class="activity-time">2 hours ago</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-avatar">RB</div>
                        <div class="activity-content">
                            <h6>Robert Brown left review</h6>
                            <p>5 stars for iPhone 14 Pro</p>
                        </div>
                        <div class="activity-time">3 hours ago</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>