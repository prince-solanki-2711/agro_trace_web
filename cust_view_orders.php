<?php
session_start();
include("header.php");
include("connect.php");

// Security Check: Preserved logic
if (!isset($_SESSION["custid"])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    /* Fresh Market Header */
    .order-header { 
        background: white; 
        padding: 4.5rem 0 3rem 0; 
        border-bottom: 2px solid var(--border-organic); 
        margin-bottom: 3rem; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .order-header h1 {
        font-family: 'Outfit', sans-serif;
        color: var(--agro-forest);
        font-weight: 800;
        font-size: 3rem;
        letter-spacing: -1.5px;
    }

    /* Professional Market Ledger */
    .ledger-container {
        background: white;
        border-radius: 30px;
        border: 1px solid var(--border-organic);
        box-shadow: 0 15px 35px rgba(27, 67, 50, 0.05);
        overflow: hidden;
        margin-bottom: 4rem;
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
        font-size: 0.95rem;
    }

    .custom-table tbody tr:hover {
        background-color: #f0fdf4;
    }

    /* Market Badge & Text Styles */
    .order-ref {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: var(--agro-leaf);
        background: var(--agro-mint);
        padding: 6px 14px;
        border-radius: 8px;
        border: 1px solid #bbf7d0;
    }

    .price-total {
        font-weight: 800;
        color: #064e3b;
        font-size: 1.1rem;
    }

    .address-box {
        max-width: 250px;
        line-height: 1.6;
        font-size: 0.85rem;
        color: #475569;
    }

    /* Agri-Action Buttons */
    .btn-action-agro {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none !important;
        transition: 0.4s;
        border: none;
    }
    
    .btn-view {
        background-color: var(--agro-forest);
        color: white;
    }
    .btn-view:hover {
        background-color: var(--agro-sun);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(255, 159, 28, 0.3);
    }

    .btn-bill {
        background-color: white;
        color: var(--agro-leaf);
        border: 2px solid var(--agro-leaf) !important;
    }
    .btn-bill:hover {
        background-color: var(--agro-mint);
        color: var(--agro-forest);
    }

    /* Empty State */
    .empty-ledger {
        padding: 6rem 0;
        text-align: center;
    }
    .empty-ledger i {
        font-size: 5rem;
        color: var(--agro-mint);
        margin-bottom: 2rem;
        opacity: 0.5;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>

<div class="page-content">
    <div class="order-header">
        <div class="container text-center animate__animated animate__fadeIn">
            <h1>My Harvest History</h1>
            <p class="text-muted lead">Track your transparent farm-to-table journey and past settlements.</p>
        </div>
    </div>

    <div class="container">
        <?php
        $custid = $_SESSION["custid"];
        // Preservation of database logic targeting original tables
        $res3 = mysqli_query($con, "SELECT * FROM order_detail WHERE Customer_id = '$custid' ORDER BY order_id DESC");
        
        if(mysqli_num_rows($res3) > 0) {
        ?>
            <div class="ledger-container animate__animated animate__fadeInUp">
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Harvest Date</th>
                                <th>Delivery Destination</th>
                                <th>Settlement</th>
                                <th class="text-center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($r3 = mysqli_fetch_array($res3)) { ?>
                                <tr>
                                    <td><span class="order-ref">#<?php echo $r3[0]; ?></span></td>
                                    <td>
                                        <div class="text-dark fw-bold"><?php echo date('d M, Y', strtotime($r3[1])); ?></div>
                                        <div class="d-flex align-items-center mt-1">
                                           
                                        </div>
                                    </td>
                                    <td>
                                        <div class="address-box">
                                            <i class="fas fa-truck-ramp-box me-1 text-success opacity-75"></i> <?php echo $r3[4]; ?>
                                            <div class="mt-1 small fw-bold"><i class="fas fa-phone-alt me-1 opacity-50"></i> <?php echo $r3[5]; ?></div>
                                        </div>
                                    </td>
                                    <td><span class="price-total">₹<?php echo number_format($r3[6], 2); ?></span></td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column gap-2 align-items-center">
                                            <a href="again_cust_view_order_detail.php?cid=<?php echo $r3[2]; ?>" class="btn-action-agro btn-view shadow-sm">
                                                <i class="fas fa-leaf"></i> View Items
                                            </a>
                                            <a href="generate_bill.php?cid=<?php echo $r3[2]; ?>" class="btn-action-agro btn-bill shadow-sm">
                                                <i class="fas fa-file-invoice-dollar"></i> Harvest Receipt
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php 
        } else { ?>
            <div class="empty-ledger animate__animated animate__zoomIn">
                <i class="fas fa-seedling"></i>
                <h2 class="text-dark fw-bold">No Harvests Found</h2>
                <p class="text-muted lead">You haven't supported any local farmers yet.</p>
                <a href="perfumes.php" class="btn btn-view mt-3 rounded-pill px-5 py-3 shadow">Explore Marketplace</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("footer.php"); ?>