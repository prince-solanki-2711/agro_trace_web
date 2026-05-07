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
        border-bottom: 3px solid #d1fae5; /* Fresh Mint Border */
        margin-bottom: 2rem;
    }

    .report-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.075em;
        font-weight: 700;
        color: #1b4332; /* Forest Green */
        padding: 1.25rem 1rem;
        border-bottom: 2px solid #f1f5f9;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        color: #334155;
        border-top: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .bill-id {
        font-weight: 700;
        color: #1b4332;
        background: #dcfce7; /* Light Green Badge */
        padding: 5px 12px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
    }

    .amount-text {
        font-weight: 800;
        color: #064e3b; /* Emerald Green */
        font-size: 1.05rem;
    }

    .customer-name {
        font-weight: 700;
        color: #1b4332;
        display: block;
    }

    .contact-info {
        font-size: 0.85rem;
        color: #475569;
        font-weight: 500;
    }

    .address-text {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.85rem;
        color: #64748b;
    }

    .btn-print {
        color: #166534;
        background: #dcfce7;
        border: 1px solid #bdf0d2;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-print:hover {
        background: #166534;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-download-pdf {
        background: #ff9f1c; /* Organic Orange */
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-download-pdf:hover {
        background: #e67e22;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 159, 28, 0.3);
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-1 text-harvest" style="color: #1b4332;">Market Settlement Report</h1>
                <p class="text-muted mb-0">Financial summary of all processed organic product transactions.</p>
            </div>
            <button class="btn-download-pdf shadow-sm" onclick="window.print()">
                <i class="fas fa-file-pdf me-2"></i> Export Financials
            </button>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="report-card">
        <?php
        // SQL Logic remains identical to your original structure
        $query = "SELECT 
                    od.order_id, 
                    od.order_date, 
                    cdet.customer_name, 
                    od.order_address, 
                    od.order_mobile, 
                    od.order_amount, 
                    od.cart_id 
                  FROM order_detail od
                  JOIN customer_detail cdet ON od.customer_id = cdet.customer_id
                  ORDER BY od.order_id DESC";

        $res = mysqli_query($con, $query);

        if(mysqli_num_rows($res) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Harvest Date</th>
                        <th>Consumer</th>
                        <th>Delivery Point</th>
                        <th>Contact No.</th>
                        <th>Total Settlement</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = mysqli_fetch_array($res)) { ?>
                    <tr>
                        <td><span class="bill-id">#INV<?php echo $r[0]; ?></span></td>
                        <td>
                            <div class="fw-bold text-dark"><?php echo date('d M, Y', strtotime($r[1])); ?></div>
                           
                        </td>
                        <td>
                            <span class="customer-name"><?php echo $r[2]; ?></span>
                        </td>
                        <td>
                            <div class="address-text" title="<?php echo $r[3]; ?>">
                                <i class="fas fa-truck-loading text-success me-1 small"></i> <?php echo $r[3]; ?>
                            </div>
                        </td>
                        <td>
                            <span class="contact-info"><i class="fas fa-phone-alt text-success me-1 small"></i> <?php echo $r[4]; ?></span>
                        </td>
                        <td>
                            <span class="amount-text">₹ <?php echo number_format($r[5], 2); ?></span>
                        </td>
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php 
        } else {
            echo "<div class='p-5 text-center text-muted'>
                    <i class='fas fa-seedling fa-4x mb-3 text-success opacity-25'></i>
                    <h5>No transaction history found</h5>
                    <p>Financial records will appear here once customers place organic orders.</p>
                  </div>";
        }
        ?>
    </div>
</div>

<?php include("footer.php"); ?>