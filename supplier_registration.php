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
      alert("Farmer Name Required (Letters only, 2-50 chars)");
      form1.txtname.focus();
      return false;
    }
    if(form1.txtadd.value == "") {
      alert("Farm/Office Address Required");
      form1.txtadd.focus();
      return false;
    }
    if(form1.txtcity.value == "" || !v_alpha.test(form1.txtcity.value)) {
      alert("Valid Region/City Name Required");
      form1.txtcity.focus();
      return false;
    }
    if(form1.txtmno.value == "" || !v_num.test(form1.txtmno.value)) {
      alert("Valid 10-Digit Mobile No Required");
      form1.txtmno.focus();
      return false;
    }
    if(form1.txtemail.value == "" || !v_email.test(form1.txtemail.value)) {
      alert("Valid Email ID Required for Digital Invoicing");
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

  $res1 = mysqli_query($con,"select * from farmer_detail where farmer_email='$email'");
  if(mysqli_num_rows($res1) > 0) {
    echo "<script>alert('Account Already Exists in our Farmer Network'); window.location='supplier_registration.php';</script>";
  } else {
    $res2 = mysqli_query($con,"select max(farmer_id) from farmer_detail");
    $row = mysqli_fetch_array($res2);
    $sid = ($row[0] == null) ? 1 : $row[0] + 1;

    $query = "insert into farmer_detail values($sid,'$name','$add','$city','$mno','$email','$pwd','Pending')";
    if(mysqli_query($con, $query)) {
      echo "<script>alert('Welcome to AgroTrace! Registration Successful. Please wait for Admin verification before signing in.'); window.location='login.php';</script>";
    } else {
      echo "<script>alert('Network Error. Registration Failed.');</script>";
    }
  }
}
?>

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --agro-mint: #95d5b2;
        --glass: rgba(255, 255, 255, 0.9);
    }

    body { 
        background-color: #f0f4f2; 
        font-family: 'Public Sans', sans-serif;
        background-image: radial-gradient(var(--agro-leaf) 0.5px, transparent 0.5px);
        background-size: 30px 30px;
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
        box-shadow: 0 40px 100px rgba(27, 67, 50, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .info-panel {
        background: var(--agro-forest);
        color: white;
        padding: 50px;
        width: 38%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }

    .form-panel {
        padding: 50px;
        width: 62%;
        background: white;
    }

    .brand-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--agro-sun);
        letter-spacing: -1px;
    }

    .feature-icon-box {
        background: rgba(255,255,255,0.1);
        padding: 30px;
        border-radius: 25px;
        text-align: center;
        margin: 30px 0;
        border: 1px border: 1px solid rgba(255,255,255,0.1);
    }

    .feature-icon-box i {
        font-size: 4rem;
        color: var(--agro-mint);
        margin-bottom: 15px;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--agro-forest);
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
        background-color: var(--agro-forest);
        color: white;
        border-radius: 15px;
        padding: 16px;
        font-weight: 800;
        width: 100%;
        border: none;
        margin-top: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.4s;
    }

    .btn-agro-register:hover {
        background-color: var(--agro-sun);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 159, 28, 0.3);
    }

    @media (max-width: 900px) {
        .register-card { flex-direction: column; border-radius: 25px; }
        .info-panel { width: 100%; padding: 40px; }
        .form-panel { width: 100%; padding: 40px; }
    }
</style>

<div class="registration-wrapper">
    <div class="register-card animate__animated animate__zoomIn">
        <div class="info-panel">
            <div>
                <h2 class="brand-title">AgroTrace <span style="color:white">Partners</span></h2>
                <p class="small opacity-75">Join our transparent network and start selling your organic harvest directly to families worldwide.</p>
                
                <div class="feature-icon-box animate__animated animate__pulse animate__infinite">
                    <i class="fas fa-seedling"></i>
                    <h5 class="fw-bold mb-0">Farmer First</h5>
                    <p class="small opacity-50">Empowering Local Roots</p>
                </div>

                <ul class="list-unstyled mt-3 small">
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle me-3 text-warning"></i> 100% Direct Profit</li>
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle me-3 text-warning"></i> Digital Traceability</li>
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle me-3 text-warning"></i> Global Farmer Badge</li>
                </ul>
            </div>
            <p class="mb-0 x-small opacity-50">© 2026 AgroTrace Ecosystem</p>
        </div>

        <div class="form-panel">
            <h3 class="fw-bold text-dark mb-1">Farmer Registration</h3>
            <p class="text-muted mb-4 small">Create your partner account to access the marketplace.</p>
            
            <form method="post" name="form1">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name / Farm Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tractor"></i></span>
                            <input type="text" class="form-control" name="txtname" placeholder="Green Valley Farms">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Origin Region / City</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-mountain-sun"></i></span>
                            <input type="text" class="form-control" name="txtcity" placeholder="e.g. Surat">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detailed Farm Address</label>
                    <textarea class="form-control" name="txtadd" placeholder="Specify plot location and landmark" rows="2"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Active Mobile Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                            <input type="text" class="form-control" name="txtmno" placeholder="10 Digit Contact">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registered Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope-circle-check"></i></span>
                            <input type="email" class="form-control" name="txtemail" placeholder="farmer@agrotrace.com">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Secure Access Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" name="txtpwd" placeholder="6-10 Characters">
                    </div>
                </div>

                <button type="submit" class="btn btn-agro-register shadow-lg" name="btnregis" onclick="return validation()">
                    Register as Verified Farmer
                </button>
                
                <div class="text-center mt-4 login-footer">
                    <p class="small text-muted mb-0">Existing partner? <a href="login.php" class="text-success fw-bold text-decoration-none">Secure Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>