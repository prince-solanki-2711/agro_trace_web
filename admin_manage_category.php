<?php
include("admin_header.php");
include("connect.php");

// Initialize variables to prevent "Undefined Variable" errors
$cat1 = ""; 
$edit_mode = false;

// --- 1. HANDLE SAVING NEW CATEGORY ---
if(isset($_POST["btnsave"])) {
    $cat = mysqli_real_escape_string($con, $_POST["txtcat"]);
    
    $res2 = mysqli_query($con, "SELECT MAX(category_id) FROM category_product");
    $row2 = mysqli_fetch_array($res2);
    $new_id = $row2[0] + 1;

    $query = "INSERT INTO category_product (category_id, category_name) VALUES ('$new_id', '$cat')";
    if(mysqli_query($con, $query)) {
        echo "<script>alert('Crop Category Saved Successfully'); window.location='admin_manage_category.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

// --- 2. HANDLE DELETING CATEGORY (With Dependency Check) ---
if(isset($_GET['dcid'])) {
    $dcid = mysqli_real_escape_string($con, $_GET['dcid']);
    
    // Check if any products are using this category
    $check_prod = mysqli_query($con, "SELECT * FROM product_detail WHERE category_id = '$dcid'");
    if(mysqli_num_rows($check_prod) > 0) {
        echo "<script>alert('Cannot Delete: This category has live products. Please remove or re-categorize products first.'); window.location='admin_manage_category.php';</script>";
    } else {
        $query = "DELETE FROM category_product WHERE category_id = '$dcid'";
        if(mysqli_query($con, $query)) {
            echo "<script>alert('Category Removed'); window.location='admin_manage_category.php';</script>";
        }
    }
}

// --- 3. PREPARE EDIT MODE ---
if(isset($_GET['ecid'])) {
    $edit_mode = true;
    $ecid = mysqli_real_escape_string($con, $_GET['ecid']);
    $res5 = mysqli_query($con, "SELECT * FROM category_product WHERE category_id = '$ecid'");
    if($r5 = mysqli_fetch_array($res5)) {
        $cat1 = $r5['category_name'];
    }
}

// --- 4. HANDLE UPDATING CATEGORY (With Dependency Check) ---
if(isset($_POST["btnupdate"])) {
    $cat = mysqli_real_escape_string($con, $_POST["txtcat"]);
    $cid = mysqli_real_escape_string($con, $_GET['ecid']);

    // Check if any products are using this category
    $check_prod = mysqli_query($con, "SELECT * FROM product_detail WHERE category_id = '$cid'");
    if(mysqli_num_rows($check_prod) > 0) {
        echo "<script>alert('Cannot Update: This category has live products. Changes are restricted to maintain data integrity.'); window.location='admin_manage_category.php';</script>";
    } else {
        $query = "UPDATE category_product SET category_name = '$cat' WHERE category_id = '$cid'";
        if(mysqli_query($con, $query)) {
            echo "<script>alert('Category Updated Successfully'); window.location='admin_manage_category.php';</script>";
        }
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f0f4f2; font-family: 'Public Sans', sans-serif; }
    .page-header { background: white; padding: 2.5rem 0; border-bottom: 3px solid #d1fae5; margin-bottom: 2rem; }
    .form-card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
    .custom-table-card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
    .btn-agro-action { background: #ff9f1c; color: white; border-radius: 10px; padding: 12px; width: 100%; transition: 0.3s; border: none; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    .btn-agro-action:hover { background: #e67e22; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(255, 159, 28, 0.3); }
    .badge-id { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-family: monospace; }
    .text-harvest { color: #1b4332; font-weight: 700; }
    .table thead th { background-color: #f8fafc; color: #1b4332; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; border: none; padding: 1.25rem; }
    .form-label { color: #1b4332; font-weight: 700; }
</style>

<script>
  function validation() {
    var v = /^[a-zA-Z ]{2,50}$/;
    var input = document.forms["form1"]["txtcat"].value;
    if(input == "") {
      alert("Please enter a category name");
      return false;
    }
    if(!v.test(input)) {
      alert("Invalid Name: Use letters only (2-50 characters)");
      return false;
    }
    return true;
  }
</script>

<div class="page-header">
    <div class="container">
        <h1 class="h3 text-harvest mb-1">Crop Categorization</h1>
        <p class="text-muted mb-0">Organize your organic products by fruit, vegetable, or grain types.</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="form-card">
                <h5 class="text-harvest mb-4">
                    <i class="fas <?php echo $edit_mode ? 'fa-pen-to-square text-warning' : 'fa-seedling text-success'; ?> me-2"></i>
                    <?php echo $edit_mode ? 'Modify Category' : 'New Crop Type'; ?>
                </h5>
                
                <form method="post" name="form1">
                    <div class="mb-4">
                        <label class="form-label small">Category Name</label>
                        <input type="text" class="form-control form-control-lg" name="txtcat" placeholder="Enter Category Name" value="<?php echo $cat1; ?>" required>
                    </div>

                    <?php if($edit_mode): ?>
                        <button type="submit" name="btnupdate" class="btn-agro-action" onclick="return validation()">
                            <i class="fas fa-arrows-rotate me-2"></i> Update Category
                        </button>
                        <div class="text-center mt-3">
                            <a href="admin_manage_category.php" class="text-muted small text-decoration-none">
                                <i class="fas fa-xmark me-1"></i> Cancel Changes
                            </a>
                        </div>
                    <?php else: ?>
                        <button type="submit" name="btnsave" class="btn-agro-action" onclick="return validation()">
                            <i class="fas fa-plus me-2"></i> Save Category
                        </button>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="custom-table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="p-4">Ref. ID</th>
                                <th class="p-4">Category Name</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-end">Management</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res3 = mysqli_query($con, "SELECT * FROM category_product ORDER BY category_id DESC");
                            if(mysqli_num_rows($res3) > 0) {
                                while($r3 = mysqli_fetch_array($res3)) {
                                    // Check if category is active (has products)
                                    $check_active = mysqli_query($con, "SELECT COUNT(*) FROM product_detail WHERE category_id = '$r3[0]'");
                                    $active_count = mysqli_fetch_array($check_active)[0];
                            ?>
                            <tr>
                                <td class="p-4"><span class="badge-id">#<?php echo $r3[0]; ?></span></td>
                                <td class="p-4">
                                    <div class="fw-bold text-dark"><?php echo $r3[1]; ?></div>
                                </td>
                                <td class="p-4">
                                    <?php if($active_count > 0): ?>
                                        <span class="badge bg-soft-success text-success" style="background:#e8f5e9; padding:5px 10px; border-radius:5px; font-size:11px;">
                                            <i class="fas fa-check-circle me-1"></i> <?php echo $active_count; ?> Live Products
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-soft-secondary text-muted" style="background:#f1f5f9; padding:5px 10px; border-radius:5px; font-size:11px;">
                                            No Products
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-end">
                                    <a href="admin_manage_category.php?ecid=<?php echo $r3[0]; ?>" 
                                       class="btn btn-sm btn-outline-success border-0 me-2" title="Edit Category">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>
                                    <a href="admin_manage_category.php?dcid=<?php echo $r3[0]; ?>" 
                                       class="btn btn-sm btn-outline-danger border-0" 
                                       onclick="return confirm('Permanently remove this crop category?')" title="Delete Category">
                                        <i class="fas fa-trash-can fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center p-5 text-muted'>No crop categories defined yet.</td></tr>";
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