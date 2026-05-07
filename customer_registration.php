<?php
include("header.php");
include("connect.php");
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Public+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
  function validation() {
    var v_alpha = /^[a-zA-Z ]{2,50}$/;
    var v_num = /^[0-9]{10,10}$/;
    var v_email = /^[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-_]+\.([a-zA-Z]{2,4})+$/;

    if(form1.txtname.value == "" || !v_alpha.test(form1.txtname.value)) {
      alert("Please enter a valid Name (Letters only, 2-50 characters)");
      form1.txtname.focus();
      return false;
    }
    if(form1.txtadd.value == "") {
      alert("Delivery Address is required for fresh produce shipping");
      form1.txtadd.focus();
      return false;
    }
    if(form1.txtcity.value == "" || !v_alpha.test(form1.txtcity.value)) {
      alert("Please enter a valid City Name");
      form1.txtcity.focus();
      return false;
    }
    if(form1.txtmno.value == "" || !v_num.test(form1.txtmno.value)) {
      alert("Please enter a valid 10-digit Mobile Number for order tracking");
      form1.txtmno.focus();
      return false;
    }
    if(form1.txtemail.value == "" || !v_email.test(form1.txtemail.value)) {
      alert("Valid Email ID Required");
      form1.txtemail.focus();
      return false;
    }
    if(form1.txtpwd.value.length < 6 || form1.txtpwd.value.length > 10) {
      alert("Security Password Must Be 6-10 Characters");
      form1.txtpwd.focus();
      return false;
    }
    return true;
  }
</script>

<?php
if(isset($_POST["btnregis"])) {
  $name = mysqli_real_escape_string($con, $_POST["txtname"]);
  $add = mysqli_real_escape_string($con, $_POST["txtadd"]);
  $city = mysqli_real_escape_string($con, $_POST["txtcity"]);
  $mno = mysqli_real_escape_string($con, $_POST["txtmno"]);
  $email = mysqli_real_escape_string($con, $_POST["txtemail"]);
  $pwd = mysqli_real_escape_string($con, $_POST["txtpwd"]);

  $res1 = mysqli_query($con,"SELECT * FROM customer_detail WHERE customer_email='$email'");
  if(mysqli_num_rows($res1) > 0) {
    echo "<script>alert('This email is already part of the AgroTrace community.'); window.location='customer_registration.php';</script>";
  } else {
    $res2 = mysqli_query($con,"SELECT MAX(customer_id) FROM customer_detail");
    $row = mysqli_fetch_array($res2);
    $cid = ($row[0] == null) ? 1 : $row[0] + 1;

    $query = "INSERT INTO customer_detail VALUES($cid,'$name','$add','$city','$mno','$email','$pwd')";
    if(mysqli_query($con, $query)) {
      echo "<script>alert('Welcome to AgroTrace! Your journey to organic living begins here.'); window.location='login.php';</script>";
    } else {
      echo "<script>alert('Database Error. Registration failed.');</script>";
    }
  }
}
?>

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --agro-mint: #dcfce7;
        --glass: rgba(255, 255, 255, 0.95);
    }

    body { 
        background-color: #f8fafc; 
        font-family: 'Public Sans', sans-serif;
        background-image: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), url('https://www.transparenttextures.com/patterns/leaf.png');
    }
    
    .registration-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
    }

    .register-card {
        max-width: 950px;
        width: 100%;
        background: var(--glass);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 40px;
        display: flex;
        overflow: hidden;
        box-shadow: 0 40px 100px rgba(27, 67, 50, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .brand-side {
        background: var(--agro-forest);
        color: white;
        padding: 50px;
        width: 40%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        position: relative;
    }

    /* Replaced GIF with Themed Icon Box */
    .feature-icon-box {
        background: rgba(255,255,255,0.1);
        padding: 40px 20px;
        border-radius: 30px;
        margin-bottom: 30px;
        border: 1px solid rgba(255,255,255,0.1);
        animation: floatAnim 4s ease-in-out infinite;
    }

    .feature-icon-box i {
        font-size: 4.5rem;
        color: var(--agro-sun);
        margin-bottom: 20px;
    }

    @keyframes floatAnim {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .form-side {
        padding: 50px;
        width: 60%;
        background: white;
    }

    .brand-logo-text {
        font-family: 'Outfit', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--agro-sun);
        letter-spacing: -1px;
    }

    .form-label {
        font-weight: 700;
        color: var(--agro-forest);
        font-size: 0.85rem;
        margin-bottom: 6px;
    }

    .input-group-text {
        background: #f8faf9;
        border: 2px solid #eef2f1;
        border-right: none;
        color: var(--agro-leaf);
        border-radius: 12px 0 0 12px;
    }

    .form-control {
        border-radius: 12px;
        border: 2px solid #eef2f1;
        background: #f8faf9;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: var(--agro-leaf);
        background: white;
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        outline: none;
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 12px 12px 0;
    }

    .btn-agro-register {
        background-color: var(--agro-leaf);
        color: white;
        border-radius: 15px;
        padding: 16px;
        font-weight: 800;
        width: 100%;
        border: none;
        margin-top: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.4s;
    }

    .btn-agro-register:hover {
        background-color: var(--agro-sun);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 159, 28, 0.3);
    }

    .sign-in-link {
        color: var(--agro-leaf);
        font-weight: 700;
        text-decoration: none;
        border-bottom: 2px solid var(--agro-mint);
        transition: 0.3s;
    }

    .sign-in-link:hover {
        color: var(--agro-sun);
        border-color: var(--agro-sun);
    }

    @media (max-width: 850px) {
        .register-card { flex-direction: column; }
        .brand-side { width: 100%; padding: 40px; }
        .form-side { width: 100%; padding: 40px; }
        .feature-icon-box { max-width: 250px; margin: 0 auto 30px auto; }
    }
</style>

<div class="registration-wrapper">
    <div class="register-card animate__animated animate__fadeInUp">
        <div class="brand-side">
            <h2 class="brand-logo-text mb-4">AgroTrace</h2>
            
            <div class="feature-icon-box">
                <i class="fas fa-shopping-basket"></i>
                <h5 class="fw-bold mb-0">Organic Basket</h5>
                <p class="small opacity-50">Farm to Table Delivery</p>
            </div>

            <h4 class="fw-bold mb-3">Join the Organic Revolution</h4>
            <p class="small opacity-75 mb-4">Start tracing your food back to the soil. Get fresh, certified organic produce delivered directly from local farms.</p>
            
            <div class="mt-auto">
                <p class="small mb-0 opacity-50">100% Secure & Transparent Delivery</p>
            </div>
        </div>

        <div class="form-side">
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-1">Consumer Registration</h3>
                <p class="text-muted small">Create an account to start shopping transparently.</p>
            </div>

            <form method="post" name="form1">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            <input type="text" class="form-control" name="txtname" placeholder="John Doe">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current City</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-location-dot"></i></span>
                            <input type="text" class="form-control" name="txtcity" placeholder="e.g. Surat">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Shipping & Delivery Address</label>
                    <textarea class="form-control" name="txtadd" placeholder="Your primary home or office address" rows="2"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mobile Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control" name="txtmno" placeholder="10 Digit Number">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="txtemail" placeholder="name@email.com">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Create Security Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-shield-check"></i></span>
                        <input type="password" class="form-control" name="txtpwd" placeholder="6-10 Characters">
                    </div>
                </div>

                <button type="submit" class="btn btn-agro-register shadow-lg" name="btnregis" onclick="return validation()">
                    Create My Agro Account
                </button>
                
                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Already a community member? 
                        <a href="login.php" class="sign-in-link ms-1">Sign In Securely</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>