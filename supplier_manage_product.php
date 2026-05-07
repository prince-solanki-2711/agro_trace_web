<?php
session_start();
include("supplier_header.php");
include("connect.php");

// --- 1. HANDLE SAVING NEW PRODUCE ---
if(isset($_POST["btnsave"])) {
    $name = mysqli_real_escape_string($con, $_POST["txtname"]);
    $catid = $_POST["selcat"];
    $desc = mysqli_real_escape_string($con, $_POST["txtdesc"]);
    $price = $_POST["txtprice"];
    $unit = mysqli_real_escape_string($con, $_POST["selunit"]); // Captured from dropdown
    $sid = $_SESSION["sid"];

    $res2 = mysqli_query($con, "SELECT MAX(product_id) FROM product_detail");
    $row2 = mysqli_fetch_array($res2);
    $pid = $row2[0] + 1;

    $tpath = $_FILES["txtimg"]["tmp_name"];
    $ipath = "perfume_img/" . time() . ".png";

    // Query includes the new unit value
    $query = "INSERT INTO product_detail VALUES($pid,'$name','$catid','$desc','$price','$unit','$ipath','$sid')";
    if(mysqli_query($con, $query)) {
        move_uploaded_file($tpath, $ipath);
        echo "<script>alert('Harvest Item Saved Successfully'); window.location='supplier_manage_product.php';</script>";
    }
}

// --- 2. HANDLE DELETING PRODUCE ---
if(isset($_REQUEST['dpid'])) {
    $pid1 = $_REQUEST['dpid'];
    $query = "DELETE FROM product_detail WHERE product_id='$pid1'";
    if(mysqli_query($con, $query)) {
        echo "<script>alert('Produce Item Removed'); window.location='supplier_manage_product.php';</script>";
    }
}

// --- 3. PREPARE EDIT MODE ---
$name1 = $cid1 = $desc1 = $price1 = $pimg1 = $unit1 = "";
if(isset($_REQUEST['epid'])) {
    $pid1 = $_REQUEST['epid'];
    $res5 = mysqli_query($con, "SELECT * FROM product_detail WHERE product_id = '$pid1'");
    $r5 = mysqli_fetch_array($res5);
    $name1 = $r5[1];
    $cid1 = $r5[2];
    $desc1 = $r5[3];
    $price1 = $r5[4];
    $unit1 = $r5[5]; // Stores the unit for the dropdown selection
    $pimg1 = $r5[6]; 
}

// --- 4. HANDLE UPDATE ---
if(isset($_POST["btnupdate"])) {
    $name = mysqli_real_escape_string($con, $_POST["txtname"]);
    $desc = mysqli_real_escape_string($con, $_POST["txtdesc"]);
    $cid = $_POST["selcat"];
    $price = $_POST["txtprice"];
    $unit = mysqli_real_escape_string($con, $_POST["selunit"]); // Updated from dropdown
    $pid = $_REQUEST['epid'];

    if($_FILES["txtimg"]["size"] > 0) {
        $tpath = $_FILES["txtimg"]["tmp_name"];
        $ipath = "perfume_img/" . time() . ".png";
        move_uploaded_file($tpath, $ipath);
        $query = "UPDATE product_detail SET product_name='$name', category_id='$cid', product_description='$desc', product_price='$price', product_unit='$unit', product_image='$ipath' WHERE product_id='$pid'";
    } else {
        $query = "UPDATE product_detail SET product_name='$name', category_id='$cid', product_description='$desc', product_price='$price', product_unit='$unit' WHERE product_id='$pid'";
    }
    if(mysqli_query($con, $query)) {
        echo "<script>alert('Harvest Details Updated'); window.location='supplier_manage_product.php';</script>";
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Public+Sans:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --agro-mint: #dcfce7;
    }
    body { background-color: #f0f4f2; font-family: 'Public Sans', sans-serif; }
    .page-header { background: white; padding: 2.5rem 0; border-bottom: 2px solid var(--agro-mint); margin-bottom: 2rem; }
    .form-card { background: white; border-radius: 20px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
    .inventory-card { background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
    .btn-save { background: var(--agro-forest); color: white; border-radius: 12px; padding: 14px; width: 100%; border: none; font-weight: 700; transition: 0.3s; text-transform: uppercase; letter-spacing: 0.5px; }
    .btn-save:hover { background: var(--agro-leaf); transform: translateY(-2px); }
    .table thead th { background: #f8fafc; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.1em; color: var(--agro-leaf); padding: 1.25rem; border-bottom: 2px solid var(--agro-mint); }
    .prod-img-preview { width: 65px; height: 65px; object-fit: cover; border-radius: 12px; border: 2px solid var(--agro-mint); }
    .price-badge { font-weight: 800; color: var(--agro-forest); font-family: 'Outfit'; }
    .badge-harvest { background: var(--agro-mint); color: var(--agro-forest); font-weight: 700; padding: 0.5em 1em; border-radius: 50px; }
</style>

<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-1" style="font-family: 'Outfit'; color: var(--agro-forest);">Harvest Inventory</h1>
                <p class="text-muted mb-0">Manage your organic produce and farm-to-table listings.</p>
            </div>
            <i class="fas fa-seedling fa-3x text-success opacity-25"></i>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="form-card animate__animated animate__fadeInLeft">
                <h5 class="fw-bold mb-4" style="color: var(--agro-forest);">
                    <i class="fas <?php echo isset($_REQUEST['epid']) ? 'fa-edit text-warning' : 'fa-plus-circle text-success'; ?> me-2"></i>
                    <?php echo isset($_REQUEST['epid']) ? 'Update Crop Details' : 'List New Harvest'; ?>
                </h5>
                <form method="post" name="form1" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Product Name</label>
                        <input type="text" class="form-control" name="txtname" value="<?php echo $name1; ?>" required style="border-radius: 10px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Crop Category</label>
                        <select class="form-control" name="selcat" required style="border-radius: 10px;">
                            <option value="0">Select Category</option>
                            <?php
                                $res6=mysqli_query($con,"select * from category_product");
                                while($r6=mysqli_fetch_array($res6)) {
                                    $sel = ($cid1 == $r6[0]) ? "selected='selected'" : "";
                                    echo "<option value='$r6[0]' $sel>$r6[1]</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Farming Description</label>
                        <textarea class="form-control" name="txtdesc" rows="3" required style="border-radius: 10px;"><?php echo $desc1; ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted">Price (₹)</label>
                            <input type="number" class="form-control" name="txtprice" value="<?php echo $price1; ?>" required style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted">Unit</label>
                            <select class="form-control" name="selunit" required style="border-radius: 10px;">
                                <option value="">Select Unit</option>
                                <option value="kg" <?php if($unit1 == 'kg') echo 'selected'; ?>>kg</option>
                                <option value="Dozen" <?php if($unit1 == 'Dozen') echo 'selected'; ?>>Dozen</option>
                                <option value="Grams" <?php if($unit1 == 'Grams') echo 'selected'; ?>>Grams</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Product Visual</label>
                        <input type="file" class="form-control" name="txtimg" id="txtimg" style="border-radius: 10px;">
                        <?php if($pimg1) echo "<img src='$pimg1' class='mt-2 rounded shadow-sm' style='width:60px; height:60px; object-fit:cover;'>"; ?>
                    </div>

                    <?php if(isset($_REQUEST['epid'])): ?>
                        <button type="submit" name="btnupdate" class="btn-save">Update Harvest Item</button>
                        <a href="supplier_manage_product.php" class="btn btn-link w-100 mt-2 text-decoration-none text-muted small">Discard Changes</a>
                    <?php else: ?>
                        <button type="submit" name="btnsave" class="btn-save shadow">Add to Marketplace</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="inventory-card animate__animated animate__fadeIn">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Produce Item</th>
                                <th>Category</th>
                                <th>Market Price</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $suppid = $_SESSION["sid"];
                            $res3=mysqli_query($con,"select * from product_detail where farmer_id = '$suppid' ORDER BY product_id DESC");
                            if(mysqli_num_rows($res3) > 0) {
                                while($r3=mysqli_fetch_array($res3)) {
                                    $res_cat=mysqli_query($con,"select category_name from category_product where category_id='$r3[2]'");
                                    $cat_row=mysqli_fetch_array($res_cat);
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $r3[6]; ?>" class="prod-img-preview me-3" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1147/1147805.png';">
                                        <div>
                                            <div class="fw-bold text-dark"><?php echo $r3[1]; ?></div>
                                           
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge-harvest"><?php echo $cat_row[0]; ?></span></td>
                                <td>
                                    <span class="price-badge">₹<?php echo number_format($r3[4], 2); ?></span>
                                    <small class="text-muted">/ <?php echo $r3[5]; ?></small> 
                                </td>
                                <td class="text-end">
                                    <a href="supplier_manage_product.php?epid=<?php echo $r3[0]; ?>" class="btn btn-sm btn-outline-success me-1" title="Edit Harvest">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="supplier_manage_product.php?dpid=<?php echo $r3[0]; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this organic item?')" title="Delete Item">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center p-5 text-muted'>
                                        <i class='fas fa-tractor fa-3x mb-3 opacity-25'></i><br>
                                        No produce listed in your farm inventory.
                                      </td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>