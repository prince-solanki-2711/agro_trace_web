<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Harvest Control | AgroTrace</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --agro-admin-dark: #1b4332; /* Deep Forest Green */
      --agro-accent: #95d5b2;      /* Fresh Mint */
      --agro-warning: #ff9f1c;     /* Organic Orange */
      --nav-height: 75px;
    }

    body {
      padding-top: var(--nav-height);
      background-color: #f0f2f5; /* Light grey for content contrast */
      font-family: 'Public Sans', sans-serif;
    }

    .navbar-admin {
      background-color: var(--agro-admin-dark) !important;
      height: var(--nav-height);
      border-bottom: 3px solid var(--agro-accent);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
      font-family: 'Outfit', sans-serif;
      font-size: 24px;
      font-weight: 700;
      color: #ffffff !important;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
    }

    .navbar-brand i {
      color: var(--agro-accent);
      margin-right: 10px;
    }

    .navbar-brand span {
      background: var(--agro-warning);
      color: #ffffff;
      font-weight: 700;
      font-size: 11px;
      text-transform: uppercase;
      padding: 2px 8px;
      border-radius: 4px;
      margin-left: 10px;
      letter-spacing: 1px;
    }

    .nav-link {
      font-size: 14px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.85) !important;
      padding: 8px 18px !important;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .nav-link i {
      font-size: 18px;
      opacity: 0.8;
    }

    .nav-link:hover {
      color: #ffffff !important;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
    }

    /* Keep track of current management section */
    .nav-item.active .nav-link {
      color: #ffffff !important;
      background: var(--agro-accent);
      color: var(--agro-admin-dark) !important;
      border-radius: 8px;
    }

    .logout-btn {
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.4);
      color: #fca5a5 !important;
      border-radius: 8px;
      margin-left: 15px;
    }

    .logout-btn:hover {
      background: #ef4444 !important;
      border-color: #ef4444;
      color: #ffffff !important;
    }

    .navbar-toggler {
      border: 1px solid var(--agro-accent);
    }

    @media (max-width: 991px) {
      .navbar-admin { height: auto; padding: 12px 0; }
      .nav-link { padding: 15px !important; border-bottom: 1px solid rgba(255,255,255,0.05); }
      .logout-btn { margin-left: 0; margin-top: 10px; }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-admin fixed-top">
  <div class="container">
    <a class="navbar-brand" href="admin_dashboard.php">
      <i class="fas fa-leaf"></i> AgroTrace <span>System Admin</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#agroAdminNavbar">
      <span class="fas fa-bars" style="color: var(--agro-accent);"></span>
    </button>

    <div class="collapse navbar-collapse" id="agroAdminNavbar">
      <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link" href="admin_dashboard.php">
            <i class="fas fa-chart-pie"></i> Market Analytics
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="admin_manage_product.php">
            <i class="fas fa-seedling"></i> Manage Produce
          </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="admin_verify_farmer.php">
          <i class="fas fa-user-check"></i> Verify Farmers
        </a>
      </li>

        <li class="nav-item">
          <a class="nav-link logout-btn" href="logout.php">
            <i class="fas fa-power-off"></i> Exit Panel
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>