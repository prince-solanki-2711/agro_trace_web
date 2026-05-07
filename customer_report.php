<?php
include("admin_header.php");
include("connect.php");

// Logic to delete customer account (Maintained original functionality)
if(isset($_GET['del_id'])) {
    $cid = mysqli_real_escape_string($con, $_GET['del_id']);
    if(mysqli_query($con, "DELETE FROM customer_detail WHERE customer_id = '$cid'")) {
        echo "<script>alert('Consumer account removed successfully'); window.location='customer_report.php';</script>";
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
        border-bottom: 2px solid #d1fae5; /* Fresh Mint Border */
        margin-bottom: 2rem;
    }

    .customer-card {
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
        color: #1b4332; /* Forest Green Headers */
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

    /* Organic Avatar Style */
    .user-avatar {
        width: 42px;
        height: 42px;
        background: #2d6a4f; /* Leaf Green */
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px; /* Modern Squircle for organic feel */
        font-weight: 700;
        margin-right: 15px;
        text-transform: uppercase;
        box-shadow: 0 4px 6px rgba(45, 106, 79, 0.2);
    }

    .contact-link {
        color: #475569;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .contact-link:hover {
        color: #ff9f1c; /* Organic Orange hover */
    }

    .city-badge {
        background: #dcfce7; /* Light Green Badge */
        color: #166534;
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .btn-remove {
        color: #94a3b8;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 12px;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-remove:hover {
        color: #dc2626;
        background: #fee2e2;
        border-color: #fca5a5;
        transform: scale(1.05);
    }

    .text-harvest {
        color: #1b4332;
        font-weight: 700;
    }
</style>

<div class="page-header text-center">
    <div class="container">
        <h1 class="text-harvest mb-2">Consumer Base Management</h1>
        <p class="text-muted mb-0">Monitor and regulate the AgroTrace consumer community.</p>
    </div>
</div>

<div class="container pb-5">
    <div class="customer-card">
        <?php
        // Query remains identical to support existing customer_detail table structure
        $res = mysqli_query($con, "SELECT * FROM customer_detail ORDER BY customer_id DESC");
        if(mysqli_num_rows($res) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="100">User ID</th>
                        <th>Consumer Profile</th>
                        <th>Contact Details</th>
                        <th>Region</th>
                        <th class="text-end">Account Control</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($r = mysqli_fetch_array($res)) { 
                        $initial = substr($r[1], 0, 1);
                    ?>
                    <tr>
                        <td class="text-muted fw-bold">#<?php echo $r[0]; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar"><?php echo $initial; ?></div>
                                <div class="fw-bold text-dark" style="font-size: 1rem;"><?php echo $r[1]; ?></div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="mailto:<?php echo $r[5]; ?>" class="contact-link mb-1">
                                    <i class="far fa-envelope me-2 text-success" style="width: 15px;"></i> <?php echo $r[5]; ?>
                                </a>
                                <a href="tel:<?php echo $r[4]; ?>" class="contact-link">
                                    <i class="fas fa-phone-alt me-2 text-success" style="width: 15px; font-size: 0.75rem;"></i> <?php echo $r[4]; ?>
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="city-badge">
                                <i class="fas fa-seedling me-2"></i> <?php echo $r[3]; ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="customer_report.php?del_id=<?php echo $r[0]; ?>" 
                               class="btn-remove" 
                               title="Deactivate Account"
                               onclick="return confirm('Permanently remove this consumer profile from the marketplace?')">
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
                <i class="fas fa-users-slash fa-4x mb-3 text-success opacity-25"></i>
                <h5 class="text-muted">No consumers have registered with the marketplace yet.</h5>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("footer.php"); ?>