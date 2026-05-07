<?php
session_start();
include("header.php");
include("connect.php");

// Security Check: Ensure consumer is logged in (Logic Preserved)
if (!isset($_SESSION["custid"])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
  function validation() {
    if(form1.txtadd.value == "") {
      alert("Delivery Address is required for the logistics team.");
      form1.txtadd.focus();
      return false;
    }
    var v = /^[0-9]{10,10}$/
    if(form1.txtmno.value == "") {
      alert("Mobile Number Required for delivery coordination.");
      form1.txtmno.focus();
      return false;
    } else if(form1.txtmno.value.length != 10) {
      alert("Mobile Number Must Be Exactly 10 Digits.");
      form1.txtmno.focus();
      return false;
    } else {
      if(!v.test(form1.txtmno.value)) {
        alert("Please enter a valid 10-digit mobile number.");
        form1.txtmno.focus();
        return false;
      }
    }
  }
</script>

<?php
if(isset($_POST["btnorder"]))
{
  $cartid = $_SESSION["cartid"];
  $custid = $_SESSION["custid"];
  $odate = date("Y-m-d");
  $add = mysqli_real_escape_string($con, $_POST["txtadd"]);
  $mno = mysqli_real_escape_string($con, $_POST["txtmno"]);

  // Calculate total amount (Database Logic Preserved)
  $res1 = mysqli_query($con,"select sum(cart_quantity*cart_price) from cart_detail where cart_id='$cartid'");
  $r1 = mysqli_fetch_array($res1);  
  $amt = $r1[0];
  
  // Generate Order ID
  $res2 = mysqli_query($con,"select max(order_id) from order_detail");
  $oid = 0;
  while($r2 = mysqli_fetch_array($res2)) {
      $oid = $r2[0];
  }
  $oid++;

  // Insert order into database
  $query = "insert into order_detail values('$oid','$odate','$cartid','$custid','$add','$mno','$amt')";
  
  if(mysqli_query($con, $query)) {
    // Redirect to Demo Payment Gateway as per original functionality
    unset($_SESSION["cartid"]);
    echo "<script>window.location.href='payment_gateway.php?amt=$amt&oid=$oid';</script>";
  } else {
    echo "<div class='alert alert-danger'>Logistics Error: ".mysqli_error($con)."</div>";
  }
}
?>

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --bg-fresh: #f8fafc;
        --border-organic: #d1fae5;
    }

    body { 
        background-color: var(--bg-fresh); 
        font-family: 'Public Sans', sans-serif; 
    }

    .order-container { 
        min-height: 80vh; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        padding: 60px 20px; 
    }

    .logistics-card {
        max-width: 600px;
        width: 100%;
        background: white;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 20px 50px rgba(27, 67, 50, 0.08);
        border: 1px solid var(--border-organic);
        position: relative;
        overflow: hidden;
    }

    /* Decorative Leaf Pattern on card */
    .logistics-card::before {
        content: '\f06c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        top: -20px;
        right: -10px;
        font-size: 8rem;
        color: var(--border-organic);
        opacity: 0.4;
        transform: rotate(15deg);
    }

    .form-control-agro { 
        border-radius: 12px; 
        padding: 15px; 
        border: 2px solid #eef2f1; 
        background: #fdfdfd;
        transition: 0.3s;
    }

    .form-control-agro:focus { 
        border-color: var(--agro-leaf); 
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        background: #fff;
        outline: none;
    }

    .btn-checkout-agro { 
        background-color: var(--agro-forest); 
        color: white; 
        padding: 18px; 
        border-radius: 15px; 
        font-weight: 800; 
        font-family: 'Outfit', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: 0.4s; 
        border: none;
        width: 100%;
    }

    .btn-checkout-agro:hover { 
        background-color: var(--agro-sun); 
        color: white; 
        transform: translateY(-3px); 
        box-shadow: 0 10px 20px rgba(255, 159, 28, 0.3);
    }

    .input-group-text-agro {
        background: #f8fafc;
        border: 2px solid #eef2f1;
        border-right: none;
        border-radius: 12px 0 0 12px;
        color: var(--agro-leaf);
        font-weight: 700;
    }

    .has-icon-agro .form-control-agro {
        border-left: none;
        border-radius: 0 12px 12px 0;
    }
</style>

<div class="container order-container">
    <div class="logistics-card animate__animated animate__zoomIn">
        <div class="text-center mb-5">
            <div class="mb-3">
                <i class="fas fa-truck-fast fa-3x text-success"></i>
            </div>
            <h2 class="fw-bold" style="font-family: 'Outfit'; color: var(--agro-forest);">Logistics & Delivery</h2>
            <p class="text-muted">Finalize your harvest destination details.</p>
        </div>

        <form method="post" name="form1">
            <div class="form-group mb-4">
                <label class="fw-bold small text-uppercase text-success" style="letter-spacing: 1px;">Destination Address</label>
                <textarea class="form-control form-control-agro" name="txtadd" 
                          placeholder="Plot/Flat No, Street Name, City, Pincode" rows="3" required></textarea>
                <small class="form-text text-muted mt-2">
                    <i class="fas fa-circle-info me-1"></i> Ensure someone is available to receive fresh produce.
                </small>
            </div>

            <div class="form-group mb-5">
                <label class="fw-bold small text-uppercase text-success" style="letter-spacing: 1px;">Delivery Contact</label>
                <div class="input-group has-icon-agro">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-group-text-agro">+91</span>
                    </div>
                    <input type="text" class="form-control form-control-agro" name="txtmno" 
                           placeholder="10-digit mobile number" required>
                </div>
            </div>

            <button type="submit" class="btn btn-checkout-agro shadow-sm" name="btnorder" onclick="return validation()">
                Confirm Order & Pay <i class="fas fa-chevron-right ms-2"></i>
            </button>
            
            <div class="text-center mt-4">
                <a href="view_cart.php" class="text-decoration-none text-muted small fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Return to Basket
                </a>
            </div>
        </form>
    </div>
</div>

<?php include("footer.php"); ?>