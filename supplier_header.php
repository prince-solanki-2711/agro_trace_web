<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Farmer Portal | AgroTrace</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --agro-farmer-bg: #1b4332; /* Deep Forest Green */
      --agro-accent: #ff9f1c;    /* Sun-ripened Orange */
      --agro-mint: #95d5b2;      /* Fresh Mint */
      --nav-height: 80px;
    }

    body {
      margin: 0;
      padding-top: var(--nav-height);
      background-color: #f0f4f2; /* Light organic grey */
      font-family: 'Public Sans', sans-serif;
    }

    .navbar-farmer {
      background-color: var(--agro-farmer-bg) !important;
      min-height: var(--nav-height);
      border-bottom: 3px solid var(--agro-mint);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .navbar-brand {
      font-family: 'Outfit', sans-serif;
      font-size: 26px;
      font-weight: 700;
      color: #ffffff !important;
      letter-spacing: -0.5px;
    }

    .navbar-brand i {
      color: var(--agro-accent);
      margin-right: 10px;
    }

    .brand-subtitle {
      color: var(--agro-mint);
      font-weight: 600;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-left: 10px;
      border-left: 1.5px solid rgba(255,255,255,0.3);
      padding-left: 12px;
    }

    .nav-link {
      font-size: 14px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.9) !important;
      padding: 10px 22px !important;
      margin: 0 3px;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .nav-link:hover {
      color: var(--agro-accent) !important;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 10px;
    }

    /* Active State Styling */
    .nav-item.active .nav-link {
      color: var(--agro-farmer-bg) !important;
      background: var(--agro-mint);
      border-radius: 10px;
    }

    .logout-pill {
      background: rgba(255, 255, 255, 0.1);
      border: 1.5px solid var(--agro-mint);
      border-radius: 50px;
      padding: 8px 25px !important;
      margin-left: 15px;
      color: var(--agro-mint) !important;
    }

    .logout-pill:hover {
      background: #dc2626 !important; /* Safety Red on hover */
      border-color: #dc2626;
      color: #ffffff !important;
    }

    .navbar-toggler {
      border: 1px solid var(--agro-mint);
    }

    @media (max-width: 991px) {
      .navbar-farmer { height: auto; padding: 15px 0; }
      .nav-link { margin: 8px 0; padding: 12px !important; border-bottom: 1px solid rgba(255,255,255,0.05); }
      .logout-pill { border-radius: 12px; margin-left: 0; margin-top: 10px; }
      .brand-subtitle { border: none; padding: 0; display: block; margin-top: 5px; }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-farmer fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="supplier_dashboard.php">
      <i class="fas fa-tractor"></i> AgroTrace <span class="brand-subtitle">Farmer Portal</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#farmerNav" aria-controls="farmerNav" aria-expanded="false">
      <span class="fas fa-bars" style="color: var(--agro-mint);"></span>
    </button>

    <div class="collapse navbar-collapse" id="farmerNav">
      <ul class="navbar-nav ml-auto align-items-center">
        
        <li class="nav-item">
          <a class="nav-link" href="supplier_dashboard.php">
            <i class="fas fa-chart-line"></i> Market Overview
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="supplier_manage_product.php">
            <i class="fas fa-seedling"></i> My Produce
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link logout-pill" href="logout.php">
            <i class="fas fa-power-off"></i> Secure Logout
          </a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<div style="margin-top: 40px;"></div>