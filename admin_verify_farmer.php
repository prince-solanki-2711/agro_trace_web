<?php
include("admin_header.php");
include("connect.php");

// 1. APPROVAL LOGIC
if(isset($_GET['approve_id'])) {
    // Sanitize the input to prevent SQL injection
    $sid = mysqli_real_escape_string($con, $_GET['approve_id']);
    
    // Update query targeting the specific column name from your SQL file
    $query = "UPDATE farmer_detail SET farmer_status='Verified' WHERE farmer_id='$sid'";
    
    if(mysqli_query($con, $query)) {
        echo "<script>alert('Farmer #$sid has been successfully verified!'); window.location='admin_verify_farmer.php';</script>";
    } else {
        // Displays exact database error if the update fails
        $db_error = mysqli_error($con);
        echo "<script>alert('Error: $db_error'); window.location='admin_verify_farmer.php';</script>";
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f0f4f2; font-family: 'Public Sans', sans-serif; }
    .text-harvest { color: #1b4332; font-weight: 700; }
    .manage-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: 2rem;
    }
    .badge-pending {
        background: #fef3c7;
        color: #92400e;
        font-weight: 600;
        padding: 0.5em 1em;
        border-radius: 50px;
        font-size: 0.75rem;
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-harvest mb-1">Farmer Verification Queue</h2>
            <p class="text-muted small">Approve new partners to give them marketplace access.</p>
        </div>
        <i class="fas fa-user-check fa-2x text-success opacity-25"></i>
    </div>

    <div class="manage-card p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Farmer Name</th>
                        <th>Region</th>
                        <th>Email Address</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetching farmers who are still 'Pending'
                    $res = mysqli_query($con, "SELECT * FROM farmer_detail WHERE farmer_status='Pending'");
                    
                    if(mysqli_num_rows($res) > 0) {
                        while($row = mysqli_fetch_array($res)) {
                    ?>
                    <tr>
                        <td>#<?php echo $row['farmer_id']; ?></td>
                        <td><strong><?php echo $row['farmer_name']; ?></strong></td>
                        <td><?php echo $row['farmer_city']; ?></td>
                        <td><?php echo $row['farmer_email']; ?></td>
                        <td><span class="badge-pending">Pending</span></td>
                        <td class="text-center">
                            <a href="admin_verify_farmer.php?approve_id=<?php echo $row['farmer_id']; ?>" 
                               class="btn btn-sm btn-success px-3" 
                               style="border-radius: 8px;"
                               onclick="return confirm('Verify this farmer?')">
                               <i class="fas fa-check-circle mr-1"></i> Approve
                            </a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center py-5 text-muted'>
                                <i class='fas fa-clipboard-check fa-3x mb-3 opacity-25'></i>
                                <p>No pending farmer registrations.</p>
                              </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>