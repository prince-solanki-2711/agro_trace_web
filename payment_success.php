<?php
include("header.php");
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

    body { 
        background-color: var(--bg-fresh); 
        font-family: 'Public Sans', sans-serif; 
    }

    .success-wrapper { 
        min-height: 70vh; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
    }

    .success-card {
        max-width: 600px;
        width: 100%;
        background: white;
        padding: 60px 40px;
        border-radius: 40px;
        box-shadow: 0 20px 50px rgba(27, 67, 50, 0.08);
        text-align: center;
        border: 1px solid #eef2f1;
        position: relative;
        overflow: hidden;
    }

    /* Success Icon Animation container */
    .icon-circle {
        width: 120px;
        height: 120px;
        background: var(--agro-mint);
        color: var(--agro-leaf);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px auto;
        font-size: 4rem;
        box-shadow: 0 10px 20px rgba(45, 106, 79, 0.1);
    }

    .success-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        color: var(--agro-forest);
        font-size: 2.5rem;
        letter-spacing: -1px;
    }

    .btn-agro-outline {
        border: 2px solid var(--agro-forest);
        color: var(--agro-forest);
        font-weight: 700;
        border-radius: 15px;
        padding: 12px 30px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-agro-outline:hover {
        background: var(--agro-forest);
        color: white !important;
    }

    .btn-agro-solid {
        background: var(--agro-sun);
        color: white;
        font-weight: 800;
        border-radius: 15px;
        padding: 12px 30px;
        transition: 0.4s;
        border: none;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 10px 20px rgba(255, 159, 28, 0.2);
    }

    .btn-agro-solid:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 159, 28, 0.3);
        color: white !important;
    }

    .leaf-decoration {
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 8rem;
        color: var(--agro-mint);
        opacity: 0.4;
        transform: rotate(-15deg);
    }
</style>

<div class="container success-wrapper">
    <div class="success-card animate__animated animate__zoomIn">
        <div class="icon-circle animate__animated animate__bounceIn">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1 class="success-title mb-3">Order Harvested!</h1>
        <p class="text-muted lead px-lg-4">Your organic selection has been processed successfully. Our farmers are preparing your delivery right now.</p>
        
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-5">
            <a href="product.php" class="btn-agro-outline mr-md-2 mb-3">
                <i class="fas fa-basket-shopping mr-2"></i> Marketplace
            </a>
            <a href="cust_view_orders.php" class="btn-agro-solid mb-3">
                <i class="fas fa-box-open mr-2"></i> Track My Harvest
            </a>
        </div>

        <div class="mt-4">
            <p class="small text-muted"><i class="fas fa-shield-check text-success mr-1"></i> A confirmation email and traceable receipt has been sent.</p>
        </div>

        <div class="leaf-decoration">
            <i class="fas fa-seedling"></i>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>