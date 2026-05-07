<?php
session_start();
include("header.php");
include("connect.php");

// --- LOGIC PRESERVED ---
if(isset($_REQUEST["dpid"]))
{
    $pid = $_REQUEST["dpid"];
    $cartid = $_SESSION["cartid"];
    $query3 = "delete from cart_detail where cart_id='$cartid' and product_id='$pid'";
    if(mysqli_query($con,$query3))
    {
        echo "<script>alert('Produce removed from basket'); window.location='view_cart.php';</script>";
    }
}

if(isset($_REQUEST["ord"]))
{
    if(isset($_SESSION["custid"]))
    {
        echo "<script>window.location='order_form.php';</script>";
    }
    else
    {
        $_SESSION["ord"]= "x";
        echo "<script>alert('Please login to complete your harvest order'); window.location='login.php';</script>";
    }
}
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --agro-mint: #dcfce7;
        --bg-fresh: #f8fafc;
        --border-organic: #d1fae5;
    }

    body { 
        background-color: var(--bg-fresh); 
        font-family: 'Public Sans', sans-serif; 
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .page-content { flex: 1; padding-bottom: 80px; }

    .cart-header { 
        background: white; 
        padding: 4.5rem 0 3rem 0; 
        border-bottom: 2px solid var(--border-organic); 
        margin-bottom: 3rem; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .cart-header h1 {
        font-family: 'Outfit', sans-serif;
        color: var(--agro-forest);
        font-weight: 800;
        font-size: 3rem;
        letter-spacing: -1.5px;
    }

    .cart-container {
        background: white;
        border-radius: 30px;
        border: 1px solid var(--border-organic);
        box-shadow: 0 15px 35px rgba(27, 67, 50, 0.05);
        overflow: hidden;
    }

    .custom-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .custom-table thead th {
        background-color: #f9fffb;
        color: var(--agro-forest);
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        padding: 1.5rem 1rem;
        border-bottom: 2px solid var(--border-organic);
    }

    .custom-table tbody td {
        padding: 1.5rem 1rem;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }

    .cart-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 18px;
        background: #fff;
        border: 2px solid var(--agro-mint);
        transition: transform 0.3s ease;
    }
    .cart-img:hover { transform: scale(1.1) rotate(3deg); }

    .prod-name { 
        font-family: 'Outfit', sans-serif;
        font-weight: 700; 
        color: var(--agro-forest); 
        font-size: 1.1rem; 
    }
    .price-text { font-weight: 500; color: #64748b; }
    .amount-total { font-weight: 800; color: var(--agro-forest); font-size: 1.1rem; }

    .qty-badge {
        background: var(--agro-mint);
        color: var(--agro-forest);
        font-weight: 800;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 1rem;
    }

    .btn-qty-edit {
        background-color: #f1f5f9;
        color: var(--agro-leaf);
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        text-decoration: none !important;
        font-weight: 700;
        transition: 0.3s;
    }
    .btn-qty-edit:hover { 
        background-color: var(--agro-leaf); 
        color: white; 
        transform: translateY(-2px);
    }

    .btn-remove {
        color: #dc2626;
        background: #fef2f2;
        border: none;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: 0.3s;
    }
    .btn-remove:hover { background: #dc2626; color: white; transform: rotate(10deg); }

    .cart-summary {
        background: white;
        padding: 40px;
        border-radius: 30px;
        border: 1px solid var(--border-organic);
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        margin-top: 30px;
    }
    .total-value { font-size: 2.5rem; font-weight: 800; color: var(--agro-leaf); font-family: 'Outfit', sans-serif; }

    .btn-checkout {
        background: var(--agro-forest);
        color: white;
        border-radius: 15px;
        padding: 18px 50px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        border: none;
        transition: 0.4s;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 10px 20px rgba(27, 67, 50, 0.2);
    }
    .btn-checkout:hover {
        background-color: var(--agro-sun);
        color: white !important;
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(255, 159, 28, 0.3);
    }

    .empty-state-icon {
        color: var(--agro-mint);
        opacity: 0.5;
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>

<div class="page-content">
    <div class="cart-header">
        <div class="container text-center animate__animated animate__fadeIn">
            <h1>My Harvest Basket</h1>
            <p class="text-muted">Direct from the fields, ready for your kitchen.</p>
        </div>
    </div>

    <div class="container">
        <?php
        $cartid = $_SESSION["cartid"];
        $tot = 0;
        $res3 = mysqli_query($con,"select * from cart_detail where cart_id = '$cartid'");
        if(mysqli_num_rows($res3) > 0) {
        ?>
            <div class="cart-container animate__animated animate__fadeInUp">
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th class="text-center">Crop Visual</th>
                                <th>Produce Details</th>
                                <th class="text-center">Weight/Qty</th>
                                <th>Unit Price</th>
                                <th>Settlement</th>
                                <th class="text-center">Adjust</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while($r3 = mysqli_fetch_array($res3)) { 
                                $res5 = mysqli_query($con,"select * from product_detail where product_id='$r3[1]'");
                                $r5 = mysqli_fetch_array($res5);
                                $amt = $r3[2] * $r3[3];
                                $tot = $tot + $amt;
                                
                                // Dynamic Unit and Fixed Image Index
                                $unit_name = $r5[5]; 
                                $image_path = $r5[6]; 
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?php echo $image_path; ?>" class="cart-img shadow-sm" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1147/1147805.png';">
                                    </td>
                                    <td>
                                        <div class="prod-name"><?php echo $r5[1]; ?></div>
                                        <div class="d-flex align-items-center mt-1">
                                            
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-badge">
                                            <?php echo $r3[2]; ?> <?php echo $unit_name; ?> </span>
                                    </td>
                                    <td><span class="price-text">₹<?php echo number_format($r3[3], 2); ?></span></td>
                                    <td><span class="amount-total">₹<?php echo number_format($amt, 2); ?></span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="update_cart_qty.php?pid=<?php echo $r3[1]; ?>&oqty=<?php echo $r3[2]; ?>" class="btn-qty-edit shadow-sm">
                                                <i class="fas fa-balance-scale me-1"></i> Adjust
                                            </a>
                                            <a href="view_cart.php?dpid=<?php echo $r3[1]; ?>" class="btn-remove shadow-sm" onclick="return confirm('Remove this produce from your basket?')">
                                                <i class="fas fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <div class="cart-summary text-end animate__animated animate__fadeInRight shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h5 text-muted mb-0 fw-bold">Basket Valuation:</span>
                            <span class="total-value">₹<?php echo number_format($tot, 2); ?></span>
                        </div>
                        <a href="view_cart.php?ord=x" class="btn-checkout">
                            Secure Checkout <i class="fas fa-truck-fast ms-2"></i>
                        </a>
                        <p class="text-muted small mt-3"><i class="fas fa-shield-check text-success me-1"></i> Every transaction supports verified organic farmers.</p>
                    </div>
                </div>
            </div>

        <?php 
        } else { ?>
            <div class="text-center py-5 animate__animated animate__zoomIn">
                <i class="fas fa-basket-shopping fa-5x mb-4 empty-state-icon"></i>
                <h2 class="text-dark fw-bold">Your basket is empty</h2>
                <p class="text-muted lead">The marketplace is full of fresh organic produce waiting for you.</p>
                <a href="product.php" class="btn btn-checkout mt-3 px-5">Explore Marketplace</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("footer.php"); ?>