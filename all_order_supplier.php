<?php
include("supplier_header.php");
include("connect.php");
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-mint: #dcfce7;
        --agro-sun: #ff9f1c;
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

    .page-content { flex: 1; }

    /* Fresh Market Header */
    .page-header { 
        background: white; 
        padding: 3rem 0; 
        border-bottom: 2px solid var(--border-organic); 
        margin-bottom: 3rem; 
    }
    .page-header h1 {
        font-family: 'Outfit', sans-serif;
        color: var(--agro-forest);
        font-weight: 800;
        font-size: 2.5rem;
        letter-spacing: -1px;
    }

    /* Market Table Container */
    .order-table-card {
        background: white;
        border-radius: 25px;
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
        letter-spacing: 0.1em;
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
        background-color: #f0fdf4; /* Very light green on hover */
    }

    /* Specialized Market UI Elements */
    .order-id-badge {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: var(--agro-leaf);
        background: var(--agro-mint);
        padding: 6px 12px;
        border-radius: 8px;
    }

    .amount-text {
        font-weight: 800;
        color: #064e3b;
        font-size: 1.05rem;
    }

    .date-text {
        color: #475569;
        font-weight: 500;
    }

    .address-cell {
        max-width: 250px;
        line-height: 1.5;
        font-size: 0.85rem;
        color: #475569;
    }

    .contact-link {
        color: var(--agro-sun);
        text-decoration: none;
        font-weight: 700;
    }
    
    .contact-link:hover { color: #e67e22; text-decoration: underline; }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .export-btn {
        background: var(--agro-forest);
        color: white;
        border: none;
        transition: 0.3s;
    }

    .export-btn:hover {
        background: var(--agro-sun);
        color: white;
        transform: translateY(-2px);
    }

</style>

<div class="page-content">
    <div class="page-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-1">Harvest Sales Ledger</h1>
                <p class="text-muted mb-0">Track produce fulfillment and marketplace transactions.</p>
            </div>
            <div class="text-end d-none d-md-block">
                <button onclick="window.print()" class="btn export-btn rounded-pill px-4 py-2 shadow-sm">
                    <i class="fas fa-file-export me-2"></i> Download Sales Log
                </button>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="order-table-card animate__animated animate__fadeInUp">
            <div class="table-responsive">
                <?php
                // Functionality: Targeting existing order_detail table

                $sid = isset($_SESSION["sid"]) ? $_SESSION["sid"] : 0;
                


               $query = mysqli_query($con, "SELECT DISTINCT od.* FROM order_detail od
            INNER JOIN cart_detail cd ON od.cart_id = cd.cart_id
            INNER JOIN product_detail pd ON cd.product_id = pd.product_id
            WHERE pd.farmer_id = '$sid'
            ORDER BY od.order_id DESC");

                if(mysqli_num_rows($query) > 0) 
                {
                    echo "<table class='custom-table'>";
                    echo "<thead>
                            <tr>
                                <th>Tracking ID</th>
                                <th>Harvest Date</th>
                                <th>Consumer Info</th>
                                <th>Delivery Point</th>
                                <th>Payment</th>
                                <th>Settlement</th>
                            </tr>
                          </thead>";
                    echo "<tbody>";

                    while ($r5 = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td><span class='order-id-badge'>#".str_pad($r5[0], 4, )."</span></td>";
                        echo "<td>
                                <div class='date-text'><i class='far fa-clock me-1 text-success'></i> " . date('d M, Y', strtotime($r5[1])) . "</div>
                              </td>";
                        echo "<td>
                                <div class='fw-bold text-dark mb-1'>Consumer #$r5[3]</div>
                                
                              </td>";
                        echo "<td class='address-cell'>
                                <i class='fas fa-truck-loading me-1 text-success'></i> $r5[4]<br>
                                <a href='tel:$r5[5]' class='contact-link small'><i class='fas fa-phone-alt me-1'></i> $r5[5]</a>
                              </td>";
                        echo "<td><span class='status-pill'><i class='fas fa-leaf me-1'></i> Completed</span></td>";
                        echo "<td><span class='amount-text'>₹ " . number_format($r5[6], 2) . "</span></td>";
                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                } 
                else 
                {
                    echo "<div class='p-5 text-center text-muted'>
                            <i class='fas fa-seedling d-block fs-1 mb-3 text-success opacity-25'></i>
                            <h5 class='fw-bold'>No harvest sales recorded.</h5>
                            <p class='small mb-0'>When consumers purchase your organic produce, they will appear here.</p>
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>