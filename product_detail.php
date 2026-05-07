<?php
session_start();
include("header.php");
include("connect.php");

// YOUR ORIGINAL LOGIC - UPDATED TO FETCH UNIT
$pid = $_REQUEST['pid'];
$res1 = mysqli_query($con, "select * from product_detail where product_id='$pid'");
$r1 = mysqli_fetch_array($res1);
$name = $r1[1];
$catid = $r1[2];
$desc = $r1[3];
$price = $r1[4];
$unit = $r1[5]; // <--- NEW: Fetching the unit (kg, Dozen, etc.)
$pimg1 = $r1[6];
$sid = $r1[7]; // Fixed index for farmer_id based on your table structure

// Cart Logic Preserved
if(isset($_POST["btncart"])) {
    $qty = $_POST["txtqty"];
    if(isset($_SESSION["cartid"])) {
        $cid = $_SESSION["cartid"];
        $query2="insert into cart_detail values('$cid','$pid','$qty','$price')";
        if(mysqli_query($con,$query2)) {
            echo "<script>alert('Produce Added to Basket'); window.location='product.php';</script>";
        }
    } else {
        $res2 = mysqli_query($con,"select max(cart_id) from cart_master");
        $cid=0;
        while($r2=mysqli_fetch_array($res2)) { $cid = $r2[0]; }
        $cid++;
        $tdate = date("Y-m-d");
        $query = "insert into cart_master values($cid,'$tdate')";
        if(mysqli_query($con, $query)) {
            $query2="insert into cart_detail values('$cid','$pid','$qty','$price')";
            if(mysqli_query($con,$query2)) {
                $_SESSION["cartid"] = $cid;
                echo "<script>alert('Produce Added to Basket'); window.location='product.php';</script>";
            }
        }
    }
}
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    function validation() {
        var v = /^[0-9]{1,3}$/;
        var qty = document.form1.txtqty.value;
        if(qty == "" || parseInt(qty) <= 0 || !v.test(qty)) {
            alert("Please enter a valid quantity (1-999)"); 
            document.form1.txtqty.focus();
            return false;
        }
        return true;
    }    
</script>

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --agro-mint: #dcfce7;
        --text-slate: #475569;
        --bg-fresh: #f8fafc;
    }

    body { background-color: var(--bg-fresh); font-family: 'Public Sans', sans-serif; }
    .product-showcase { padding: 100px 0; }
    .img-display-container { background: white; border-radius: 40px; padding: 50px; border: 1px solid #e2e8f0; box-shadow: 0 20px 40px rgba(0,0,0,0.03); text-align: center; position: sticky; top: 120px; transition: 0.4s; }
    .img-display-container img { max-width: 100%; height: auto; max-height: 450px; object-fit: contain; border-radius: 20px; transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .img-display-container:hover img { transform: scale(1.05) rotate(2deg); }
    .product-title-agro { font-family: 'Outfit', sans-serif; font-size: 3.5rem; font-weight: 800; color: var(--agro-forest); margin-bottom: 15px; letter-spacing: -1.5px; line-height: 1; }
    .price-agro { font-size: 2.2rem; font-weight: 800; color: var(--agro-sun); margin-bottom: 30px; display: block; }
    .desc-box { background: white; padding: 30px; border-radius: 25px; border-left: 6px solid var(--agro-sun); margin-bottom: 40px; color: var(--text-slate); line-height: 1.8; box-shadow: 0 10px 20px rgba(0,0,0,0.02); }
    .cart-form-box { background: #fff; padding: 40px; border-radius: 30px; border: 1px solid #e2e8f0; box-shadow: 0 20px 40px rgba(27, 67, 50, 0.05); }
    .form-label-agro { font-weight: 700; font-size: 0.9rem; color: var(--agro-forest); margin-bottom: 12px; display: block; }
    .qty-input { height: 60px; border-radius: 15px; border: 2px solid #f1f5f9; background: #f8fafc; text-align: center; font-weight: 800; font-size: 1.1rem; margin-bottom: 20px; transition: 0.3s; }
    .qty-input:focus { border-color: var(--agro-leaf); background: white; outline: none; }
    .btn-add-agro { background: var(--agro-forest); color: white; height: 60px; border-radius: 15px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: 0.4s; border: none; width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; }
    .btn-add-agro:hover { background: var(--agro-sun); transform: translateY(-3px); box-shadow: 0 15px 30px rgba(255, 159, 28, 0.3); color: white; }
    .trust-list { margin-top: 30px; padding: 0; list-style: none; }
    .trust-list li { font-size: 0.9rem; color: var(--text-slate); margin-bottom: 12px; display: flex; align-items: center; font-weight: 500; }
    .trust-list i { width: 30px; height: 30px; background: var(--agro-mint); color: var(--agro-leaf); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 0.8rem; }
</style>

<div class="product-showcase">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="img-display-container shadow-sm">
                    <img src="<?php echo $pimg1; ?>" alt="<?php echo $name; ?>" onerror="this.src='https://images.unsplash.com/photo-1610348725531-843dff563e2c?auto=format&fit=crop&w=600&q=80';">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product-meta">
                    <h1 class="product-title-agro"><?php echo $name; ?></h1>
                    
                    <span class="price-agro">
                        ₹ <?php echo number_format($price, 2); ?> 
                        <small style="font-size: 1rem; color: #94a3b8; font-weight: 400;">/ <?php echo $unit ;  ?></small> </span>

                    <div class="desc-box">
                        <h6 class="fw-bold text-success mb-2 small text-uppercase" style="letter-spacing:2px;">Produce Bio & Origin</h6>
                        <p class="mb-0"><?php echo $desc; ?></p>
                    </div>

                    <div class="cart-form-box">
                        <form method="post" name="form1">
                            <div class="row align-items-end">
                                <div class="col-md-5">
                                    <label class="form-label-agro">Quantity in <?php echo $unit;  ?></label> <input type="number" class="form-control qty-input" name="txtqty" value="1" min="1">
                                </div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn-add-agro" onclick="return validation();" name="btncart">
                                        <i class="fas fa-shopping-basket"></i> Add to Basket
                                    </button>
                                </div>
                            </div>
                        </form>

                        <ul class="trust-list">
                            <li><i class="fas fa-seedling"></i> 100% Certified Organic Harvest</li>
                            <li><i class="fas fa-tractor"></i> Direct from Verified Farmer #<?php echo $sid; ?></li>
                            <li><i class="fas fa-truck-fast"></i> Farm-to-Table Delivery (24-48 Hours)</li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>