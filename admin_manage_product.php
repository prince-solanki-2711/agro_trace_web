<?php
include("admin_header.php");
include("connect.php");

// Logic to delete a product (Functionality remains identical to the original perfume site)
if(isset($_GET['del_id'])) {
    $pid = $_GET['del_id'];
    $res = mysqli_query($con, "SELECT product_image FROM product_detail WHERE product_id = '$pid'");
    if($row = mysqli_fetch_array($res)) {
        $img_path = $row['product_image'];
        if(file_exists($img_path)) { unlink($img_path); }
    }
    $query = "DELETE FROM product_detail WHERE product_id='$pid'";
    if(mysqli_query($con, $query)) {
        echo "<script>alert('Harvest Item Deleted Successfully'); window.location='admin_manage_product.php';</script>";
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
        border-bottom: 2px solid #d1fae5; /* Soft mint border */
        margin-bottom: 2rem;
    }

    .manage-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.075em;
        font-weight: 700;
        color: #1b4332; /* Deep Forest Green */
        padding: 1.25rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .table tbody td {
        padding: 1.25rem;
        vertical-align: middle;
        color: #334155;
    }

    .prod-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #ecfdf5;
    }

    .price-tag {
        font-weight: 700;
        color: #064e3b; /* Emerald green */
    }

    .badge-category {
        background: #dcfce7; /* Light green badge */
        color: #166534;
        font-weight: 600;
        padding: 0.5em 1em;
        border-radius: 50px; /* Pill style for organic feel */
        font-size: 0.75rem;
    }

    .btn-delete-icon {
        color: #dc2626;
        background: #fee2e2;
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-delete-icon:hover {
        background: #dc2626;
        color: white;
        transform: rotate(9deg);
        text-decoration: none;
    }

    .text-harvest {
        color: #1b4332;
        font-weight: 700;
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 text-harvest mb-1">Harvest Inventory</h1>
                <p class="text-muted mb-0">Monitor and regulate the supply of organic produce.</p>
            </div>
            <i class="fas fa-leaf fa-2x text-success opacity-25"></i>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="manage-card">
        <?php
        // SQL query remains identical, product_unit is included in p.*
        $sql = "SELECT p.*, 
                (SELECT category_name FROM category_product WHERE category_id = p.category_id) as cat_name,
                (SELECT farmer_name FROM farmer_detail WHERE farmer_id = p.farmer_id) as sup_name
                FROM product_detail p
                ORDER BY p.product_id DESC";
        $result = mysqli_query($con, $sql);

        if($result && mysqli_num_rows($result) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center">Product</th>
                        <th>Harvest Details</th>
                        <th>Crop Category</th>
                        <th>Farmer / Source</th>
                        <th>Market Price</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_array($result)) { 
                        $display_cat = $row['cat_name'] ? $row['cat_name'] : "Seasonal";
                        $display_sup = $row['sup_name'] ? $row['sup_name'] : "Direct Farm";
                        $display_unit = $row['product_unit']; // New variable for the unit
                    ?>
                    <tr>
                        <td class="text-center">
                            <img src="<?php echo $row['product_image']; ?>" class="prod-img" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1147/1147805.png';">
                        </td>
                        <td>
                            <div class="fw-bold text-dark"><?php echo $row['product_name']; ?></div>
                            
                        </td>
                        <td><span class="badge-category"><?php echo $display_cat; ?></span></td>
                        <td><span class="text-secondary"><i class="fas fa-tractor mr-1 small"></i> <?php echo $display_sup; ?></span></td>
                        <td>
                            <span class="price-tag">₹ <?php echo number_format($row['product_price'], 2); ?></span>
                            <br>
                            <small class="text-muted">per <?php echo $display_unit; ?></small> </td>
                        <td class="text-center">
                            <a href="admin_manage_product.php?del_id=<?php echo $row['product_id']; ?>" 
                               class="btn-delete-icon" 
                               title="Remove from Marketplace"
                               onclick="return confirm('Remove this organic item from the live inventory?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
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
                    <h5>No produce in stock</h5>
                    <p>Wait for farmers to upload their latest harvest or add items manually.</p>
                  </div>";
        }
        ?>
    </div>
</div>

<?php include("footer.php"); ?>