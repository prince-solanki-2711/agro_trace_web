<?php
session_start();
include("supplier_header.php");
include("connect.php");

// Security check and Session variable alignment (Functionality remains identical)
if (!isset($_SESSION["sid"])) {
    echo "<script>alert('Please Login First'); window.location.href='login.php';</script>";
    exit();
}

$supplier_id = $_SESSION["sid"]; 

// 1. Total Products Count (Harvest Items)
$total_perfumes = mysqli_num_rows(mysqli_query($con, "SELECT * FROM product_detail WHERE farmer_id = '$supplier_id'")) ?? 0;

// 2. Total Orders Count (Market Sales)
$order_query = "SELECT DISTINCT o.order_id 
                FROM order_detail o 
                JOIN cart_detail c ON o.cart_id = c.cart_id 
                JOIN product_detail p ON c.product_id = p.product_id 
                WHERE p.farmer_id = '$supplier_id'";
$total_orders = mysqli_num_rows(mysqli_query($con, $order_query)) ?? 0;

// 3. Total Earnings Calculation (Harvest Revenue)
$revenue_query = "SELECT SUM(c.cart_price * c.cart_quantity) as total_revenue 
                  FROM cart_detail c 
                  JOIN product_detail p ON c.product_id = p.product_id 
                  JOIN order_detail o ON c.cart_id = o.cart_id
                  WHERE p.farmer_id = '$supplier_id'";
$revenue_result = mysqli_query($con, $revenue_query);
$revenue_data = mysqli_fetch_assoc($revenue_result);
$total_revenue = $revenue_data['total_revenue'] ?? 0;
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&family=Public+Sans:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f8fafc;
        font-family: 'Public Sans', sans-serif;
    }
    .supplier-container {
        padding: 50px 15px;
    }
    .stat-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        position: relative;
        overflow: hidden;
        color: white;
        min-height: 170px;
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }
    .icon-bg {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 5rem;
        opacity: 0.15;
        transform: rotate(-15deg);
    }
    .dash-header h1 {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        color: #1b4332; /* Forest Green */
        letter-spacing: -1px;
    }
    .btn-outline-light-custom {
        border: 1px solid rgba(255,255,255,0.4);
        backdrop-filter: blur(4px);
        color: white;
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-outline-light-custom:hover {
        background: white;
        color: #1b4332;
    }
    .quick-action-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 25px;
        text-decoration: none !important;
        color: #1b4332;
        transition: 0.3s;
        display: block;
    }
    .quick-action-card:hover {
        background: #f0fdf4;
        border-color: #95d5b2;
        transform: scale(1.02);
    }
    .badge-harvest {
        background-color: #dcfce7;
        color: #166534;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
    }
</style>

<div class="container supplier-container">
    <div class="row mb-5">
        <div class="col-md-8">
            <h1 class="mb-2">Farmer Overview</h1>
            <p class="text-muted">Direct Marketplace Control for Partner ID: <span class="fw-bold text-success">#AT-F<?php echo $supplier_id; ?></span></p>
        </div>
        <div class="col-md-4 text-md-right align-self-center">
            <span class="badge-harvest shadow-sm">
                <i class="fas fa-tractor mr-2"></i> Verified Agro-Partner
            </span>
        </div>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm" style="background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%);">
                <div class="card-body p-4">
                    <small class="text-uppercase font-weight-bold opacity-75">My Harvest Items</small>
                    <h2 class="display-4 font-weight-bold my-2"><?php echo $total_perfumes; ?></h2>
                    <a href="supplier_manage_product.php" class="btn btn-sm btn-outline-light-custom px-3">Update Inventory</a>
                    <i class="fas fa-seedling icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card shadow-sm" style="background: linear-gradient(135deg, #ff9f1c 0%, #e67e22 100%);">
                <div class="card-body p-4">
                    <small class="text-uppercase font-weight-bold opacity-75">Market Orders</small>
                    <h2 class="display-4 font-weight-bold my-2"><?php echo $total_orders; ?></h2>
                    <a href="all_order_supplier.php" class="btn btn-sm btn-outline-light-custom px-3">Logistics View</a>
                    <i class="fas fa-shopping-basket icon-bg"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card shadow-sm" style="background: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);">
                <div class="card-body p-4">
                    <small class="text-uppercase font-weight-bold opacity-75">Total Revenue</small>
                    <h2 class="display-4 font-weight-bold my-2">₹<?php echo number_format($total_revenue); ?></h2>
                    <a href="supplier_bill_report.php" class="btn btn-sm btn-outline-light-custom px-3">Financial Report</a>
                    <i class="fas fa-file-invoice-dollar icon-bg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="mb-4 font-weight-bold text-dark">Quick Harvest Actions</h4>
        </div>
        <div class="col-md-4 mb-3">
            <a href="supplier_manage_product.php" class="quick-action-card shadow-sm">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-plus-circle text-success fa-2x mr-3"></i>
                    <h5 class="mb-0 fw-bold">List New Produce</h5>
                </div>
                <p class="text-muted small mb-0">Upload your latest batch of fresh fruits, vegetables, or grains.</p>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="supplier_bill_report.php" class="quick-action-card shadow-sm">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-receipt text-warning fa-2x mr-3"></i>
                    <h5 class="mb-0 fw-bold">Sales Settlements</h5>
                </div>
                <p class="text-muted small mb-0">Track payments and download invoices for your sold produce.</p>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="contact.php" class="quick-action-card shadow-sm">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-headset text-primary fa-2x mr-3"></i>
                    <h5 class="mb-0 fw-bold">Farmer Support</h5>
                </div>
                <p class="text-muted small mb-0">Need help with logistics? Contact our market administrators.</p>
            </a>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>