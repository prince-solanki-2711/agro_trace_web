<?php
include("admin_header.php");
include("connect.php");

// Logic to remove unwanted supplier (Functionality preserved from original perfume site)
if(isset($_GET['del_id'])) {
    // Sanitize input for security
    $sid = mysqli_real_escape_string($con, $_GET['del_id']);
    
    // First, delete all produce associated with this farmer
    mysqli_query($con, "DELETE FROM product_detail WHERE farmer_id = '$sid'");
    
    // Then, delete the farmer account
    if(mysqli_query($con, "DELETE FROM farmer_detail WHERE farmer_id = '$sid'")) {
        echo "<script>alert('Farmer and their organic produce have been removed'); window.location='supplier_report.php';</script>";
    } else {
        echo "<script>alert('Error removing farmer profile');</script>";
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f0f4f2; font-family: 'Public Sans', sans-serif; }
    
    .page-header {
        background: white;
        padding: 2.5rem 0;
        border-bottom: 3px solid #d1fae5; /* Soft Mint Border */
        margin-bottom: 2rem;
    }

    .supplier-card {
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
    }

    .table tbody tr {
        transition: background-color 0.2s;
    }

    .table tbody tr:hover {
        background-color: #f9fffb;
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        color: #334155;
        border-top: 1px solid #f1f5f9;
    }

    /* Farmer Icon Style */
    .vendor-icon {
        width: 42px;
        height: 42px;
        background: #dcfce7;
        color: #166534;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 15px;
        font-size: 1.2rem;
    }

    .contact-link {
        color: #475569;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .contact-link:hover {
        color: #ff9f1c; /* Organic Orange */
    }

    .city-badge {
        background: #fef3c7; /* Warm Harvest Yellow */
        color: #92400e;
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .btn-remove-vendor {
        color: #94a3b8;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 12px;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
    }

    .btn-remove-vendor:hover {
        color: #dc2626;
        background: #fee2e2;
        border-color: #fca5a5;
        transform: scale(1.05);
    }

    .badge-id {
        background: #dcfce7;
        color: #166534;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-family: monospace;
    }

    .text-harvest {
        color: #1b4332;
        font-weight: 700;
    }
</style>

<div class="page-header text-center">
    <div class="container">
        <h1 class="text-harvest mb-2">Farmer Network Management</h1>
        <p class="text-muted mb-0">Review verified farmers and manage the AgroTrace supply chain.</p>
    </div>
</div>

<div class="container pb-5">
    <div class="supplier-card">
        <?php
        // Query targets the existing supplier_detail table from your perfume database
        $query = mysqli_query($con, "SELECT * FROM farmer_detail");

        if(mysqli_num_rows($query) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="120">Farmer ID</th>
                        <th>Farmer / Farm Name</th>
                        <th>Region / Origin</th>
                        <th>Contact Channels</th>
                        <th class="text-end">Management</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><span class="badge-id">#<?php echo $row[0]; ?></span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="vendor-icon"><i class="fas fa-tractor"></i></div>
                                <div class="fw-bold text-dark" style="font-size: 1rem;"><?php echo $row[1]; ?></div>
                            </div>
                        </td>
                        <td>
                            <span class="city-badge"><i class="fas fa-mountain-sun me-2"></i> <?php echo $row[3]; ?></span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="mailto:<?php echo $row[5]; ?>" class="contact-link mb-1">
                                    <i class="far fa-envelope me-2 text-success" style="width: 15px;"></i> <?php echo $row[5]; ?>
                                </a>
                                <a href="tel:<?php echo $row[4]; ?>" class="contact-link">
                                    <i class="fas fa-phone-alt me-2 text-success" style="width: 15px; font-size: 0.75rem;"></i> <?php echo $row[4]; ?>
                                </a>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="supplier_report.php?del_id=<?php echo $row[0]; ?>" 
                               class="btn-remove-vendor" 
                               title="Deactivate Farmer"
                               onclick="return confirm('Permanently remove this farmer? This will also unlist all their organic produce from the marketplace.')">
                                <i class="fas fa-user-slash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
            <div class="p-5 text-center">
                <i class="fas fa-seedling fa-4x mb-3 text-success opacity-25"></i>
                <h5 class="text-muted">No farmers have joined the network yet.</h5>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("footer.php"); ?>