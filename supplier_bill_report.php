<?php
session_start();
include("supplier_header.php");
include("connect.php");

// Security check: Ensure farmer/supplier is logged in
if (!isset($_SESSION["sid"])) {
    echo "<script>alert('Access Denied. Please log in to your Farmer Portal.'); window.location.href='login.php';</script>";
    exit();
}

$suppid = $_SESSION["sid"];
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

    .page-content { flex: 1; padding-bottom: 4rem; }

    /* Market-Style Page Header */
    .report-header { 
        background: white; 
        padding: 3.5rem 0; 
        border-bottom: 2px solid var(--border-organic); 
        margin-bottom: 2.5rem; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .report-header h1 {
        font-family: 'Outfit', sans-serif;
        color: var(--agro-forest);
        font-weight: 800;
        font-size: 2.5rem;
        letter-spacing: -1px;
    }

    /* Market Table Container */
    .table-container {
        background: white;
        border-radius: 25px;
        border: 1px solid var(--border-organic);
        box-shadow: 0 15px 35px rgba(27, 67, 50, 0.05);
        overflow: hidden;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
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
        text-align: left;
    }

    .custom-table tbody td {
        padding: 1.5rem 1rem;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .custom-table tbody tr:hover {
        background-color: #f0fdf4; /* Light mint hover */
    }

    /* Specialized UI Components */
    .id-badge {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: var(--agro-leaf);
        background: var(--agro-mint);
        padding: 6px 14px;
        border-radius: 8px;
        border: 1px solid #bbf7d0;
    }

    .currency {
        font-weight: 800;
        color: #064e3b;
        font-size: 1.1rem;
    }

    .btn-details {
        background: var(--agro-forest);
        color: white;
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none !important;
        transition: 0.4s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-details:hover {
        background: var(--agro-sun);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 159, 28, 0.3);
        color: white;
    }

    .address-text {
        font-size: 0.85rem;
        color: #475569;
        max-width: 250px;
        line-height: 1.6;
    }

    .date-badge {
        color: var(--agro-leaf);
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .farmer-id-tag {
        background: var(--agro-forest);
        color: white;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(27, 67, 50, 0.2);
    }
</style>

<div class="page-content">
    <div class="report-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="animate__animated animate__fadeInLeft">Harvest Sales Statement</h1>
                    <p class="text-muted mb-0">Track revenue and order details for your organic produce.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="farmer-id-tag animate__animated animate__fadeInRight">
                        <i class="fas fa-tractor me-2 text-warning"></i>Farmer ID: AT-F<?php echo $suppid; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="table-container animate__animated animate__fadeInUp shadow">
            <div class="table-responsive">
                <?php
                // Functionality: Unchanged logic targeting existing tables
                $query = "SELECT DISTINCT
                            od.order_id,
                            od.order_date,
                            od.cart_id,
                            cdet.customer_name,
                            od.order_address,
                            od.order_mobile,
                            od.order_amount
                          FROM order_detail od
                          JOIN customer_detail cdet ON od.customer_id = cdet.customer_id
                          JOIN cart_detail c ON od.cart_id = c.cart_id
                          JOIN product_detail p ON c.product_id = p.product_id
                          WHERE p.farmer_id = '$suppid'
                          ORDER BY od.order_date DESC";

                $res = mysqli_query($con, $query);

                if(mysqli_num_rows($res) > 0) 
                {
                    echo "<table class='custom-table'>";
                    echo "<thead>
                            <tr>
                                <th>Harvest ID</th>
                                <th>Billing Date</th>
                                <th>Consumer Name</th>
                                <th>Delivery Location</th>
                                <th>Settlement Amount</th>
                                
                            </tr>
                          </thead>";
                    echo "<tbody>";

                    while ($r = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td><span class='id-badge'>#".str_pad($r[0], 4, )."</span></td>";
                        echo "<td><div class='date-badge'><i class='far fa-clock me-2 text-success opacity-75'></i>" . date('d M, Y', strtotime($r[1])) . "</div></td>";
                        echo "<td class='fw-bold text-dark'>$r[3]</td>";
                        echo "<td>
                                <div class='address-text'><i class='fas fa-map-marker-alt me-1 text-success'></i> $r[4]</div>
                                <div class='small mt-1 font-weight-bold'><i class='fas fa-phone-alt me-1 text-muted'></i> $r[5]</div>
                              </td>";
                        echo "<td><span class='currency'>₹ " . number_format($r[6], 2) . "</span></td>";
                        
                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                } 
                else 
                {
                    echo "<div class='p-5 text-center text-muted'>
                            <i class='fas fa-seedling fa-3x mb-3 text-success opacity-25'></i>
                            <h5 class='fw-bold'>No harvest sales recorded yet.</h5>
                            <p class='small'>Your settlements will appear here as soon as consumers purchase your crops.</p>
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>