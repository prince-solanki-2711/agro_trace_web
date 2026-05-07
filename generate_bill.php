<?php
session_start();
include("header.php"); 
include("connect.php"); 

// --- Security Check (Logic Preserved) ---
if (!isset($_SESSION["custid"])) {
    echo "<script>alert('Please log in to view harvest receipts.'); window.location.href='login.php';</script>";
    exit();
}

if (!isset($_REQUEST["cid"])) {
    echo "<script>alert('Invalid Receipt Request. Missing Batch ID.'); window.location.href='cust_view_orders.php';</script>";
    exit();
}

$cartid = mysqli_real_escape_string($con, $_REQUEST["cid"]);
$custid_session = $_SESSION["custid"];

// 1. Fetch Harvest Order Details
$order_sql = "SELECT order_id, order_date, customer_id, order_address, order_mobile, order_amount FROM order_detail WHERE cart_id = '$cartid'";
$order_res = mysqli_query($con, $order_sql);

if(mysqli_num_rows($order_res) == 0) {
    echo "<script>alert('Settlement record not found.'); window.location.href='cust_view_orders.php';</script>";
    exit();
}

$order_data = mysqli_fetch_assoc($order_res);
$order_id = $order_data['order_id'];
$order_date = $order_data['order_date'];
$custid_db = $order_data['customer_id'];
$delivery_address = $order_data['order_address'];
$delivery_mno = $order_data['order_mobile'];
$total_amount = $order_data['order_amount'];

if ($custid_db != $custid_session) {
    echo "<script>alert('Access Denied: Record mismatch.'); window.location.href='cust_view_orders.php';</script>";
    exit();
}

// 2. Fetch Consumer Details
$customer_sql = "SELECT customer_name, customer_email FROM customer_detail WHERE customer_id = '$custid_db'";
$customer_res = mysqli_query($con, $customer_sql);
$customer_data = mysqli_fetch_assoc($customer_res);
$customer_name = $customer_data['customer_name'];
$customer_email = $customer_data['customer_email'];

// 3. Fetch Harvest Line Items (UPDATED TO INCLUDE product_unit)
$items_sql = "SELECT cd.cart_quantity, cd.cart_price, pd.product_name, pd.product_unit 
              FROM cart_detail cd 
              JOIN product_detail pd ON cd.product_id = pd.product_id 
              WHERE cd.cart_id = '$cartid'";
$items_res = mysqli_query($con, $items_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settlement #AT-<?php echo $order_id; ?> - AgroTrace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --agro-forest: #1b4332;
            --agro-leaf: #2d6a4f;
            --agro-sun: #ff9f1c;
            --agro-mint: #dcfce7;
            --bg-fresh: #f1f5f2;
        }

        body { font-family: 'Public Sans', sans-serif; background-color: var(--bg-fresh); color: #334155; }
        
        .invoice-wrapper { max-width: 850px; margin: 50px auto; padding: 40px; background: white; border-radius: 30px; box-shadow: 0 20px 50px rgba(27, 67, 50, 0.1); position: relative; overflow: hidden; border: 1px solid #e2e8f0; }

        .invoice-wrapper::after { content: '\f012'; font-family: 'Font Awesome 6 Free'; font-weight: 900; position: absolute; top: -30px; right: -20px; font-size: 10rem; color: var(--agro-mint); opacity: 0.3; transform: rotate(15deg); }

        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 3px solid var(--agro-mint); padding-bottom: 30px; margin-bottom: 40px; }
        
        .brand-logo { font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: var(--agro-forest); display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-logo i { color: var(--agro-sun); }

        .receipt-title { font-family: 'Outfit', sans-serif; font-size: 40px; font-weight: 800; color: var(--agro-forest); margin: 0; text-transform: uppercase; letter-spacing: -1.5px; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 40px; }
        .info-section h6 { font-family: 'Outfit', sans-serif; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--agro-leaf); font-size: 0.75rem; margin-bottom: 12px; }
        .info-content { font-size: 0.95rem; line-height: 1.6; }

        .traceability-bar { background: var(--agro-mint); padding: 15px 25px; border-radius: 12px; margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #bbf7d0; }
        .trace-id { font-family: monospace; font-weight: 700; color: var(--agro-forest); font-size: 1rem; }

        .agro-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .agro-table th { background: var(--agro-forest); color: white; padding: 15px; font-family: 'Outfit', sans-serif; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; }
        .agro-table td { padding: 18px 15px; border-bottom: 1px solid #f1f5f9; font-size: 1rem; color: #475569; }
        .agro-table tr:last-child td { border-bottom: none; }

        .total-box { background: #f8fafc; padding: 25px; border-radius: 15px; text-align: right; margin-left: auto; width: fit-content; min-width: 300px; border: 1px solid #e2e8f0; }
        .grand-total { font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; color: var(--agro-forest); }

        .footer-note { margin-top: 50px; text-align: center; font-size: 0.85rem; color: #94a3b8; border-top: 1px dashed #e2e8f0; padding-top: 30px; }
        
        .no-print { margin-bottom: 20px; }
        .btn-agro-print { background: var(--agro-forest); color: white; border: none; padding: 10px 25px; border-radius: 50px; font-weight: 700; transition: 0.3s; }
        .btn-agro-print:hover { background: var(--agro-sun); transform: translateY(-2px); }

        @media print {
            body { background: white; }
            .invoice-wrapper { box-shadow: none; border: none; margin: 0; padding: 0; width: 100%; }
            .no-print, .agro-table th { -webkit-print-color-adjust: exact; }
            .invoice-wrapper::after { display: none; }
        }
    </style>
</head>
<body>

<div class="container py-4 text-end no-print">
    <button onclick="window.print()" class="btn-agro-print shadow-sm">
        <i class="fas fa-print me-2"></i> Print Harvest Receipt
    </button>
</div>

<div class="invoice-wrapper">
    <div class="invoice-header">
        <div>
            <a href="index.php" class="brand-logo">
                <i class="fas fa-seedling"></i> AGROTRACE
            </a>
            <p class="text-muted small mt-1 mb-0">Certified Transparent Organic Marketplace</p>
        </div>
        <h1 class="receipt-title">RECEIPT</h1>
    </div>

    <div class="traceability-bar">
        <div class="date-badge"><i class="fas fa-calendar-check me-2 text-success"></i> Settlement Date: <strong><?php echo date("d M, Y", strtotime($order_date)); ?></strong></div>
        
    </div>

    <div class="info-grid">
        <div class="info-section">
            <h6>Billed to Consumer</h6>
            <div class="info-content">
                <strong><?php echo htmlspecialchars($customer_name); ?></strong><br>
                <?php echo htmlspecialchars($customer_email); ?>
            </div>
        </div>
        <div class="info-section text-end">
            <h6>Delivery Logistics</h6>
            <div class="info-content">
                <?php echo nl2br(htmlspecialchars($delivery_address)); ?><br>
                <strong>Contact:</strong> +91 <?php echo htmlspecialchars($delivery_mno); ?>
            </div>
        </div>
    </div>

    <table class="agro-table">
        <thead>
            <tr>
                <th style="width: 10%;">#</th>
                <th style="width: 45%; text-align: left;">Harvest Description</th>
                <th style="width: 15%;">Qty</th>
                <th style="width: 15%;">Rate (₹)</th>
                <th style="width: 15%; text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $subtotal = 0;
            while($item = mysqli_fetch_assoc($items_res)) {
                $item_qty = $item['cart_quantity'];
                $item_price = $item['cart_price'];
                $item_name = $item['product_name'];
                $item_unit = $item['product_unit']; //
                $item_amount = $item_qty * $item_price;
                $subtotal += $item_amount;
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td style="text-align: left;">
                    <strong><?php echo htmlspecialchars($item_name); ?></strong><br>
                    <small class="text-muted"><i class="fas fa-qrcode me-1"></i> Verified Organic Batch</small>
                </td>
                <td><?php echo $item_qty . ' ' . htmlspecialchars($item_unit); ?></td>
                <td><?php echo number_format($item_price, 2); ?></td>
                <td style="text-align: right; font-weight: 600;">₹<?php echo number_format($item_amount, 2); ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="total-box">
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Harvest Settlement:</span>
            <span class="fw-bold">₹<?php echo number_format($subtotal, 2); ?></span>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
            <span class="h5 mb-0 fw-bold">Total Paid:</span>
            <span class="grand-total">₹<?php echo number_format($total_amount, 2); ?></span>
        </div>
    </div>

    <div class="footer-note">
        <p class="mb-1"><i class="fas fa-shield-check text-success me-2"></i> This receipt serves as your digital proof of transparency for the AgroTrace ecosystem.</p>
        <p class="small">Scan your batch QR codes in the 'Trace' app to view soil health and farmer certification.</p>
    </div>
</div>

<?php include("footer.php"); ?>