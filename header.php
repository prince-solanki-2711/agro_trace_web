<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AgroTrace | Transparent Organic Marketplace</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Public+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --agro-green: #2d6a4f; /* Fresh Leaf Green */
      --agro-mint: #95d5b2;  /* Light Organic Accent */
      --agro-orange: #ff9f1c; /* Sun-ripened Harvest Orange */
      --nav-height: 90px;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Public Sans', sans-serif;
      padding-top: var(--nav-height);
      background-color: #fcfdfc;
    }

    .navbar {
      background-color: #ffffff !important;
      min-height: var(--nav-height);
      padding-top: 0;
      padding-bottom: 0;
      border-bottom: 4px solid var(--agro-green);
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .navbar-brand {
      font-family: 'Outfit', sans-serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--agro-green) !important;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
    }

    .navbar-brand i {
      color: var(--agro-orange);
      margin-right: 10px;
    }

    .navbar-nav .nav-link {
      font-size: 15px;
      font-weight: 600;
      color: #334155 !important;
      padding: 32px 18px !important;
      transition: all 0.3s ease;
      position: relative;
    }

    /* Organic Leaf-Style Hover Effect */
    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      bottom: 25px;
      left: 18px;
      right: 18px;
      height: 3px;
      background: var(--agro-orange);
      transform: scaleX(0);
      border-radius: 10px;
      transition: transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: var(--agro-green) !important;
    }

    .navbar-nav .nav-link:hover::after {
      transform: scaleX(1);
    }

    /* Marketplace Dropdown */
    .dropdown-menu {
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      margin-top: -5px;
      box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
      padding: 10px;
      overflow: hidden;
    }

    .dropdown-item {
      color: #475569;
      font-size: 14px;
      font-weight: 600;
      padding: 12px 20px;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .dropdown-item:hover {
      background-color: #f0fdf4;
      color: var(--agro-green);
    }

    /* Cart/Basket Styling */
    .nav-basket {
      color: var(--agro-green) !important;
    }

    /* Mobile Toggler */
    .navbar-toggler {
      border: 2px solid var(--agro-green);
      padding: 5px 8px;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(45, 106, 79, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E") !important;
    }

    @media (max-width: 991px) {
      .navbar { height: auto; padding: 15px 0; }
      .navbar-nav .nav-link { padding: 15px !important; }
      .navbar-nav .nav-link::after { display: none; }
      .dropdown-menu { border: none; box-shadow: none; padding-left: 25px; }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <i class="fas fa-seedling"></i> AGROTRACE
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Marketplace</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">Our Roots</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product.php">Organic Products</a>
        </li>

        <?php if(isset($_SESSION["cartid"])): ?>
          <li class="nav-item">
            <a class="nav-link nav-basket" href="view_cart.php">
              <i class="fas fa-shopping-basket mr-1"></i> My Cart
            </a>
          </li> 
        <?php endif; ?>

        <?php if(isset($_SESSION["custid"])): ?>
          <li class="nav-item">
            <a class="nav-link" href="cust_view_orders.php">My Orders</a>
          </li>
        <?php else: ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
              Join Us
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="supplier_registration.php"><i class="fas fa-tractor mr-2"></i>Farmer Portal</a>
              <a class="dropdown-item" href="customer_registration.php"><i class="fas fa-user-plus mr-2"></i>Customer Join</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php" style="color: var(--agro-green) !important; font-weight: 700;">Sign In</a>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">Support</a>
        </li>

        <?php if(isset($_SESSION["custid"])): ?>
          <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php" style="font-weight: 700;">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-top: 40px;"></div>