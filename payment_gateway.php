<?php
session_start();
include("header.php");

// Fetch the amount and order ID passed from order_form.php (Logic Preserved)
$amount = isset($_GET['amt']) ? $_GET['amt'] : "0";
$oid = isset($_GET['oid']) ? $_GET['oid'] : "0";
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-sun: #ff9f1c;
        --agro-mint: #dcfce7;
        --bg-fresh: #f8fafc;
    }

    body { background-color: var(--bg-fresh); font-family: 'Public Sans', sans-serif; }

    .payment-container { 
        max-width: 550px; 
        margin: 60px auto; 
        background: #fff; 
        padding: 40px; 
        border-radius: 30px; 
        box-shadow: 0 20px 50px rgba(27, 67, 50, 0.08); 
        border: 1px solid #eef2f1;
    }

    .payment-title { 
        font-family: 'Outfit', sans-serif;
        font-weight: 800; 
        color: var(--agro-forest); 
        letter-spacing: -1px;
    }

    .nav-pills .nav-link { 
        color: var(--agro-forest); 
        font-weight: 700; 
        border: 2px solid #f1f5f9; 
        margin: 0 5px; 
        border-radius: 12px;
        transition: 0.3s;
    }

    .nav-pills .nav-link.active { 
        background-color: var(--agro-forest); 
        color: white; 
        border-color: var(--agro-forest); 
    }

    .btn-pay { 
        background: var(--agro-forest); 
        color: white; 
        width: 100%; 
        padding: 16px; 
        border-radius: 15px; 
        font-weight: 800; 
        font-family: 'Outfit', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none; 
        transition: 0.4s; 
        margin-top: 25px; 
    }

    .btn-pay:hover { 
        background: var(--agro-sun); 
        color: white; 
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 159, 28, 0.3);
    }

    .order-summary { 
        background: var(--agro-mint); 
        padding: 20px; 
        border-radius: 20px; 
        margin-bottom: 30px; 
        border: 1px solid #bbf7d0;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 15px;
        border: 2px solid #f1f5f9;
        font-weight: 600;
    }

    .form-control:focus {
        border-color: var(--agro-leaf);
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        outline: none;
    }

    .upi-input-group { position: relative; }
    .upi-badge { position: absolute; right: 15px; top: 38px; width: 40px; }
    
    .secure-badge {
        color: #059669;
        font-weight: 700;
        font-size: 0.85rem;
    }
</style>

<div class="container animate__animated animate__fadeIn">
    <div class="payment-container">
        <div class="text-center mb-4">
            <div class="mb-2">
                <i class="fas fa-shield-heart fa-3x text-success"></i>
            </div>
            <h3 class="payment-title">Secure Checkout</h3>
            <p class="text-muted">Finalize your harvest settlement</p>
        </div>

        <div class="order-summary d-flex justify-content-between align-items-center">
            <div>
               
                <span class="font-weight-bold text-dark h5">Total Valuation</span>
            </div>
            <h3 class="mb-0 font-weight-bold" style="color: var(--agro-forest);">₹<?php echo number_format($amount); ?></h3>
        </div>

        <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab">
                    <i class="fas fa-credit-card mr-2"></i>Bank Card
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-upi-tab" data-toggle="pill" href="#pills-upi" role="tab">
                    <i class="fas fa-mobile-screen mr-2"></i>UPI Transfer
                </a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-card" role="tabpanel">
                <form class="demo-form">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted text-uppercase">Account Holder</label>
                        <input type="text" class="form-control" placeholder="John Doe" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted text-uppercase">Card Number</label>
                        <input type="text" class="form-control" placeholder="4580 0000 0000 1234" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="small font-weight-bold text-muted text-uppercase">Expiry Date</label>
                            <input type="text" class="form-control" placeholder="MM/YY" required>
                        </div>
                        <div class="col-6">
                            <label class="small font-weight-bold text-muted text-uppercase">CVV Code</label>
                            <input type="password" class="form-control" placeholder="***" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-pay">Authorize Payment</button>
                </form>
            </div>

            <div class="tab-pane fade" id="pills-upi" role="tabpanel">
                <form class="demo-form text-center">
                    <div class="mb-4">
                        <i class="fas fa-qrcode fa-5x text-success mb-3 opacity-75"></i>
                        <p class="small text-muted fw-bold">Scan QR code using GooglePay, PhonePe, or BHIM</p>
                    </div>
                    
                    <div class="text-muted mb-3 small font-weight-bold text-uppercase" style="letter-spacing: 1px;">- OR ENTER VPA - </div>
                    
                    <div class="form-group text-left upi-input-group">
                        <label class="small font-weight-bold text-muted text-uppercase text-left d-block">UPI ID (VPA)</label>
                        <input type="text" class="form-control" placeholder="username@bank" required>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo-vector.svg" class="upi-badge" alt="UPI">
                    </div>
                    <button type="submit" class="btn btn-pay">Pay via UPI App</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <span class="secure-badge"><i class="fas fa-lock me-1"></i> 256-bit SSL Secure Settlement</span>
            <p class="small text-muted mt-2">Every purchase supports sustainable organic farming.</p>
        </div>
    </div>
</div>

<script>
// Universal handler for both forms (Logic Preserved)
document.querySelectorAll('.demo-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('.btn-pay');
        btn.innerHTML = '<i class="fas fa-leaf fa-spin mr-2"></i>Verifying Agro-Transaction...';
        btn.disabled = true;

        // Simulating bank authorization delay
        setTimeout(function() {
            window.location.href = 'payment_success.php';
        }, 2500);
    });
});
</script>

<?php include("footer.php"); ?>