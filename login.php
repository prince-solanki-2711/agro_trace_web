<?php
session_start();
include("header.php");
include("connect.php");

if(isset($_POST["btnlogin"]))
{
    // Functionality remains 100% identical to original
    $email = mysqli_real_escape_string($con, $_POST["txtemail"]);
    $pwd = mysqli_real_escape_string($con, $_POST["txtpwd"]);

    // 1. Check Admin
    $res1 = mysqli_query($con,"select * from admin_detail where admin_email='$email' and admin_pass='$pwd'");
    if(mysqli_num_rows($res1)>0)
    {
      echo"<script>alert('Logged In As System Admin'); window.location.href='admin_dashboard.php';</script>";
    }
    else
    {
        // 2. Check Supplier (Farmer)
        $res2 = mysqli_query($con, "select * from farmer_detail where farmer_email='$email' and farmer_pass='$pwd'");
if(mysqli_num_rows($res2) > 0)
{
    $r2 = mysqli_fetch_array($res2);
    
    // Check if the farmer's status is 'Pending'
    if(isset($r2['farmer_status']) && $r2['farmer_status'] == 'Pending') {
        echo "<script>alert('Your account is awaiting Admin verification. Please check back later.'); window.location.href='login.php';</script>";
    } else {
        $_SESSION["sid"] = $r2[0];
        echo "<script>alert('Logged In As Farmer Partner'); window.location.href='supplier_dashboard.php';</script>";
    }
}
        else
        {
            // 3. Check Customer (Consumer)
            $res3 = mysqli_query($con,"select * from customer_detail where customer_email='$email' and customer_pass='$pwd'");
            if(mysqli_num_rows($res3)>0)
            {
              $r3=mysqli_fetch_array($res3);
              $_SESSION["custid"] = $r3[0];
              
              if(isset($_SESSION["ord"]))
              {
                unset($_SESSION["ord"]);
                echo"<script>alert('Logged In As Consumer'); window.location.href='order_form.php';</script>";
              }
              else
              {
                echo"<script>alert('Logged In As Consumer'); window.location.href='product.php';</script>";
              }
            }
            else
            {
              echo"<script>alert('Invalid Credentials. Please try again.'); window.location.href='login.php';</script>";
            }
        }
    }
}
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Public+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --glass: rgba(255, 255, 255, 0.9);
    }

    body { 
        background-color: #f0f4f2; 
        font-family: 'Public Sans', sans-serif;
        /* Dynamic Organic Pattern */
        background-image: radial-gradient(var(--agro-leaf) 0.5px, transparent 0.5px);
        background-size: 30px 30px;
        background-opacity: 0.1;
    }
    
    .login-container {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        max-width: 900px;
        width: 100%;
        background: var(--glass);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 40px;
        overflow: hidden;
        display: flex;
        box-shadow: 0 40px 100px rgba(27, 67, 50, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    /* Left Side: Visual/GIF Section */
    .login-visual {
        flex: 1;
        background: var(--agro-forest);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        color: white;
        position: relative;
    }

    .login-gif {
        width: 100%;
        max-width: 280px;
        border-radius: 30px;
        margin-bottom: 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        animation: floatAnim 4s ease-in-out infinite;
    }

    @keyframes floatAnim {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    /* Right Side: Form Section */
    .login-form-side {
        flex: 1.2;
        padding: 60px;
        background: white;
    }

    .brand-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 2.5rem;
        color: var(--agro-forest);
        letter-spacing: -1.5px;
    }

    .form-label {
        font-weight: 700;
        color: var(--agro-forest);
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 15px;
        padding: 14px 20px;
        border: 2px solid #eef2f1;
        background: #f8faf9;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: var(--agro-leaf);
        background: white;
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        outline: none;
    }

    .input-group-text {
        background: #f8faf9;
        border: 2px solid #eef2f1;
        border-right: none;
        color: var(--agro-leaf);
        border-radius: 15px 0 0 15px;
    }

    .has-icon .form-control {
        border-left: none;
        border-radius: 0 15px 15px 0;
    }

    .btn-agro-login {
        background: var(--agro-forest);
        color: white;
        border-radius: 15px;
        padding: 16px;
        font-weight: 800;
        width: 100%;
        border: none;
        margin-top: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.4s;
    }

    .btn-agro-login:hover {
        background: var(--agro-sun);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 159, 28, 0.3);
    }

    .login-footer-text {
        margin-top: 2.5rem;
        font-size: 0.9rem;
        color: #64748b;
    }

    @media (max-width: 850px) {
        .login-visual { display: none; }
        .login-card { max-width: 450px; }
    }
</style>

<div class="container login-container">
    <div class="login-card animate__animated animate__zoomIn">
        <div class="login-visual">
            <img src="https://cdn-icons-gif.flaticon.com/17905/17905764.gif" class="login-gif" alt="AgroTrace Login">
            <h4 class="fw-bold mb-2">Welcome Back!</h4>
            <p class="text-center opacity-75 small">Access your secure portal to manage the organic harvest and marketplace activities.</p>
        </div>

        <div class="login-form-side">
            <div class="mb-5">
                <h1 class="brand-title">AgroTrace</h1>
                <p class="text-muted">Enter your secure credentials to continue.</p>
            </div>

            <form method="post">
                <div class="mb-4">
                    <label class="form-label">Market Email Address</label>
                    <div class="input-group has-icon">
                        <span class="input-group-text"><i class="fas fa-envelope-open-text"></i></span>
                        <input type="email" class="form-control" name="txtemail" placeholder="farmer@agrotrace.com" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label">Security Password</label>
                    <div class="input-group has-icon">
                        <span class="input-group-text"><i class="fas fa-shield-halved"></i></span>
                        <input type="password" class="form-control" name="txtpwd" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-agro-login shadow" name="btnlogin">
                    Authenticate Securely
                </button>
            </form>

            <div class="login-footer-text text-center">
                <p class="mb-2">Secured by AgroTrace Blockchain Connectivity</p>
                <a href="index.php" class="contact-link small">
                    <i class="fas fa-chevron-left me-1"></i> Return to Homepage
                </a>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>