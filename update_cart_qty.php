<?php
session_start();
include("header.php");
include("connect.php");

// YOUR ORIGINAL LOGIC - UPDATED TO FETCH UNIT AND FIX IMAGE INDEX
$oqty = $_REQUEST['oqty'];
$pid = $_REQUEST['pid'];
$res1 = mysqli_query($con, "select * from product_detail where product_id='$pid'");
$r1 = mysqli_fetch_array($res1);
$name = $r1[1];
$catid = $r1[2];
$desc = $r1[3];
$price = $r1[4];
$unit = $r1[5]; // <--- NEW: Fetching the unit (kg, Dozen, etc.)
$pimg1 = $r1[6]; // <--- FIXED: Updated index to 6 for the product image
$sid = $r1[7]; // Fixed index for farmer_id
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    function validation() {
        var v = /^[0-9]{1,3}$/;
        var qtyInput = document.form1.txtqty.value;
        if(qtyInput == "") {
            alert("Please enter the weight/quantity");
            document.form1.txtqty.focus();
            return false;
        }
        else if(parseInt(qtyInput) <= 0) {
            alert("Please enter a valid weight/quantity");
            document.form1.txtqty.focus();
            return false;
        }
        else if(!v.test(qtyInput)) {
            alert("Quantity must be a valid number");
            document.form1.txtqty.focus();
            return false;
        }
        return true;
    }    
</script>

<?php
    if(isset($_POST["btnupdate"])) {
        $qty = $_POST["txtqty"];
        $cid = $_SESSION["cartid"];
        // Preservation of database logic targeting original tables
        $query2 = "update cart_detail set cart_quantity='$qty' where cart_id='$cid' and product_id='$pid'";
        if(mysqli_query($con, $query2)) {
            $_SESSION["cartid"] = $cid;
            echo "<script>alert('Harvest Basket Updated Successfully'); window.location='view_cart.php';</script>";
        }
    }
?>

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --agro-mint: #dcfce7;
        --bg-fresh: #f8fafc;
    }

    body { 
        background-color: var(--bg-fresh); 
        font-family: 'Public Sans', sans-serif; 
    }

    .page-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        color: var(--agro-forest);
        margin-bottom: 2rem;
        letter-spacing: -1px;
    }

    .product-preview-img {
        max-height: 450px;
        width: 100%;
        object-fit: contain;
        border-radius: 30px;
        background: white;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #eef2f1;
    }

    .agro-update-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 35px;
        padding: 40px;
        box-shadow: 0 25px 50px -12px rgba(27, 67, 50, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .info-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        color: var(--agro-leaf);
        margin-bottom: 5px;
    }

    .info-value {
        font-family: 'Outfit', sans-serif;
        color: var(--agro-forest);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .form-control-agro {
        height: 60px;
        border-radius: 15px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        font-weight: 700;
        font-size: 1.2rem;
        padding-left: 20px;
        color: var(--agro-forest);
        transition: 0.3s;
    }

    .form-control-agro:focus {
        border-color: var(--agro-sun);
        background: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(255, 159, 28, 0.1);
    }

    .btn-update-basket {
        background: var(--agro-forest);
        color: white;
        height: 60px;
        border-radius: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        width: 100%;
        transition: 0.4s;
        margin-top: 10px;
    }

    .btn-update-basket:hover {
        background: var(--agro-sun);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 159, 28, 0.3);
        color: white;
    }

    .batch-id {
        display: inline-block;
        background: var(--agro-mint);
        color: var(--agro-leaf);
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        margin-bottom: 15px;
    }
</style>

<div class="container py-5 my-5">
    <div class="row align-items-center">
        <div class="col-md-12 text-center mb-5">
            <h1 class="page-title animate__animated animate__fadeInDown">Adjust Harvest Quantity</h1>
            <div class="leaf-divider text-success"><i class="fas fa-balance-scale fa-2x"></i></div>
        </div>
    </div>

    <div class="row g-5 align-items-center">
        <div class="col-md-6">
            <div class="position-relative animate__animated animate__fadeInLeft">
                <img src="<?php echo $pimg1; ?>" class="product-preview-img" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1147/1147805.png';">
               
            </div>
        </div>

        <div class="col-md-6">
            <div class="agro-update-card animate__animated animate__fadeInRight">
                <form method="post" name="form1">
                    
                    
                    <div class="info-group">
                        <p class="info-label">Produce Name</p>
                        <h3 class="info-value"><?php echo $name; ?></h3>
                    </div>

                    <div class="info-group">
                        <p class="info-label">Origin & Farm Details</p>
                        <p class="text-muted" style="line-height: 1.6;"><?php echo $desc; ?></p>
                    </div>

                    <div class="info-group">
                        <p class="info-label">Current Market Price</p>
                        <h4 class="info-value text-success">₹ <?php echo number_format($price, 2); ?> <small class="text-muted" style="font-size: 0.8rem;">/ <?php echo $unit; ?></small></h4> </div>

                    <div class="form-group mb-4">
                        <label class="info-label" style="color: var(--agro-forest);">Modify Quantity in <?php echo $unit; ?></label> <div class="input-group">
                            <span class="input-group-text bg-white border-end-0" style="border-radius: 15px 0 0 15px; border: 2px solid #f1f5f9;">
                                <i class="fas fa-shopping-basket text-success"></i>
                            </span>
                            <input type="number" class="form-control form-control-agro border-start-0" name="txtqty" 
                                   placeholder="Enter Quantity" value="<?php echo $oqty; ?>" style="border-radius: 0 15px 15px 0;">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-update-basket shadow" onclick="return validation();" name="btnupdate">
                        <i class="fas fa-sync-alt me-2"></i> Update Harvest Basket
                    </button>
                    
                    <div class="text-center mt-3">
                        <a href="view_cart.php" class="text-decoration-none text-muted small fw-bold hover-success">
                            <i class="fas fa-chevron-left me-1"></i> Return to Basket
                        </a>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>