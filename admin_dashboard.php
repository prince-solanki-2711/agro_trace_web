<?php
include("admin_header.php");
include("connect.php");

// Fetch counts with error handling - logic remains exactly same as perfume site
$total_customers = mysqli_num_rows(mysqli_query($con, "SELECT * FROM customer_detail")) ?? 0;
$total_suppliers = mysqli_num_rows(mysqli_query($con, "SELECT * FROM farmer_detail")) ?? 0;
$total_products  = mysqli_num_rows(mysqli_query($con, "SELECT * FROM product_detail")) ?? 0;
$total_orders    = mysqli_num_rows(mysqli_query($con, "SELECT * FROM order_detail")) ?? 0;

// Category check
$cat_table_check = mysqli_query($con, "SHOW TABLES LIKE 'category_detail'");
$total_categories = (mysqli_num_rows($cat_table_check) > 0) 
    ? mysqli_num_rows(mysqli_query($con, "SELECT * FROM category_detail")) 
    : 0;
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f8fafc; /* Lighter, cleaner background */
        font-family: 'Public Sans', sans-serif;
    }
    hr {
        display: none; 
    }
    .dashboard-container {
        padding: 40px 15px;
    }
    .stat-card {
        border: none;
        border-radius: 20px; /* More rounded, friendly edges */
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        min-height: 170px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .icon-bg {
        font-size: 3.5rem;
        position: absolute;
        right: -10px;
        bottom: -10px;
        opacity: 0.15;
        transform: rotate(-15deg);
    }
    .btn-action {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 10px;
        transition: 0.3s;
    }
    .btn-action:hover {
        background: white;
        color: #1b4332;
    }
    .dash-title {
        font-weight: 800;
        color: #1b4332; /* Forest Green */
        letter-spacing: -1px;
    }
    .text-harvest {
        color: #ff9f1c; /* Carrot Orange */
        font-weight: 600;
    }
</style>

<div class="container dashboard-container">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="dash-title">AgroTrace Console</h1>
            <p class="text-secondary">Managing the <span class="text-harvest">Organic Harvest</span> & Farmer Logistics</p>
        </div>
    </div>
    
    <div class="row g-4">
        
        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm text-white" style="background: linear-gradient(135deg, #2d6a4f, #1b4332);">
                <div class="card-body p-4">
                    <small class="text-uppercase fw-bold opacity-75">Available Produce</small>
                    <h2 class="display-5 fw-bold mb-3"><?php echo $total_products; ?></h2>
                    <a href="admin_manage_product.php" class="btn btn-action px-4">Inventory</a>
                    <i class="fas fa-seedling icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm text-white" style="background: linear-gradient(135deg, #ff9f1c, #e67e22);">
                <div class="card-body p-4">
                    <small class="text-uppercase fw-bold opacity-75">Market Sales</small>
                    <h2 class="display-5 fw-bold mb-3"><?php echo $total_orders; ?></h2>
                    <a href="all_order_report.php" class="btn btn-action px-4">Sales Log</a>
                    <i class="fas fa-shopping-basket icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm text-white" style="background: linear-gradient(135deg, #4361ee, #3f37c9);">
                <div class="card-body p-4">
                    <small class="text-uppercase fw-bold opacity-75">Consumer Base</small>
                    <h2 class="display-5 fw-bold mb-3"><?php echo $total_customers; ?></h2>
                    <a href="customer_report.php" class="btn btn-action px-4">User List</a>
                    <i class="fas fa-user-check icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm text-white" style="background: linear-gradient(135deg, #74c69d, #52b788);">
                <div class="card-body p-4">
                    <small class="text-uppercase fw-bold opacity-75">Categorization</small>
                    <h2 class="display-5 fw-bold mb-3">Crop Types</h2>
                    <a href="admin_manage_category.php" class="btn btn-action px-4">Modify</a>
                    <i class="fas fa-leaf icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm text-white" style="background: linear-gradient(135deg, #9b2226, #ae2012);">
                <div class="card-body p-4">
                    <small class="text-uppercase fw-bold opacity-75">Verified Farmers</small>
                    <h2 class="display-5 fw-bold mb-3"><?php echo $total_suppliers; ?></h2>
                    <a href="supplier_report.php" class="btn btn-action px-4">Farmer Portal</a>
                    <i class="fas fa-tractor icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm text-white" style="background: linear-gradient(135deg, #588157, #3a5a40);">
                <div class="card-body p-4">
                    <small class="text-uppercase fw-bold opacity-75">Financials</small>
                    <h2 class="display-5 fw-bold mb-3">Settlements</h2>
                    <a href="admin_bill_report.php" class="btn btn-action px-4">Invoices</a>
                    <i class="fas fa-file-invoice icon-bg"></i>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("footer.php"); ?>