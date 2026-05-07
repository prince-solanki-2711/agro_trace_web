<?php
include("admin_header.php");
include("connect.php");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f0f4f2; font-family: 'Public Sans', sans-serif; }
    
    .page-header {
        background: white;
        padding: 2.5rem 0;
        border-bottom: 2px solid #d1fae5;
        margin-bottom: 2rem;
    }

    .order-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.075em;
        font-weight: 700;
        color: #1b4332; /* Forest Green */
        padding: 1.2rem 1rem;
        border: none;
    }

    .table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        color: #334155;
        border-top: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .order-id {
        font-weight: 700;
        color: #1b4332;
        background: #dcfce7; /* Light Green Badge */
        padding: 5px 10px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
    }

    .amount-cell {
        font-weight: 700;
        color: #064e3b; /* Emerald Green */
    }

    .address-box {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #475569;
    }

    .text-harvest {
        color: #1b4332;
        font-weight: 700;
    }

    .export-btn {
        background: #ff9f1c; /* Organic Orange */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s;
    }

    .export-btn:hover {
        background: #e67e22;
        color: white;
        transform: translateY(-2px);
    }

    @media print {
        .export-btn, .navbar, .admin-footer { display: none !important; }
        .page-header { padding: 1rem 0; }
        body { background: white; }
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 text-harvest mb-1">Market Transaction Log</h1>
                <p class="text-muted mb-0">Complete history of organic produce sales and logistics.</p>
            </div>
            <button class="export-btn shadow-sm" onclick="window.print()">
                <i class="fas fa-file-export me-2"></i> Download Sales Report
            </button>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="order-card">
        <?php
        // Database logic remains identical to the original perfume site
        $query = mysqli_query($con, "SELECT order_detail.*, customer_detail.customer_name 
                             FROM order_detail 
                             INNER JOIN customer_detail 
                             ON order_detail.customer_id = customer_detail.customer_id 
                             ORDER BY order_detail.order_id DESC");

        if(mysqli_num_rows($query) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Ref. ID</th>
                        <th>Harvest Date</th>
                        <th>Consumer Details</th>
                        <th>Delivery Destination</th>
                        <th>Contact</th>
                        <th>Total Settlement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><span class="order-id">#<?php echo $r[0]; ?></span></td>
                        <td>
                            <div class="small text-muted">
                                <i class="far fa-clock me-1 text-success"></i> 
                                <?php echo date("d M, Y", strtotime($r[1])); ?>
                            </div>
                        </td>
                        <td>
                           <div class="fw-bold text-dark"><?php echo $r['customer_name']; ?></div>
                            <div class="small text-muted">ID: #<?php echo $r['customer_id']; ?></div>
                            
                        </td>
                        <td>
                            <div class="address-box" title="<?php echo $r[4]; ?>">
                                <i class="fas fa-truck-loading text-warning me-1 small"></i> <?php echo $r[4]; ?>
                            </div>
                        </td>
                        <td>
                            <a href="tel:<?php echo $r[5]; ?>" class="text-decoration-none text-success font-weight-bold small">
                                <i class="fas fa-phone-alt me-1"></i> <?php echo $r[5]; ?>
                            </a>
                        </td>
                        <td><span class="amount-cell">₹ <?php echo number_format($r[6], 2); ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php 
        } else {
            echo "<div class='p-5 text-center'>
                    <i class='fas fa-seedling fa-4x mb-3 text-success opacity-25'></i>
                    <h5 class='text-muted'>No sales recorded in the marketplace yet.</h5>
                  </div>";
        }
        ?>
    </div>
</div>

<?php include("footer.php"); ?>