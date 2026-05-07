<?php
include("header.php");
include("connect.php");

// Initialize filter variables (Preserved Logic)
$cid = isset($_GET['cid']) ? $_GET['cid'] : '';
$price_filter = isset($_GET['price']) ? $_GET['price'] : '';

// Base query (Preserved Logic - using existing table names)
$query = "SELECT p.*, c.category_name 
          FROM product_detail p 
          JOIN category_product c ON p.category_id = c.category_id 
          WHERE 1=1";

if ($cid != '') { $query .= " AND p.category_id = '$cid'"; }

if ($price_filter != '') {
    if ($price_filter == 'low') { $query .= " AND p.product_price < 3000"; }
    elseif ($price_filter == 'mid') { $query .= " AND p.product_price BETWEEN 3000 AND 7000"; }
    elseif ($price_filter == 'high') { $query .= " AND p.product_price > 7000"; }
}
?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Public+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    /* Fresh Header Section */
    .gallery-header { 
        padding: 5rem 0 3rem 0; 
        text-align: center;
        background: linear-gradient(to bottom, #f0fdf4, var(--bg-fresh));
    }
    .gallery-header h1 { 
        font-family: 'Outfit', sans-serif; 
        font-size: 3.5rem; 
        color: var(--agro-forest); 
        font-weight: 800;
        letter-spacing: -1.5px;
    }
    .gallery-header .leaf-divider { 
        font-size: 1.5rem;
        color: var(--agro-sun);
        margin: 15px 0;
    }

    /* Professional Sidebar Filter */
    .filter-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 25px;
        padding: 30px;
        position: sticky;
        top: 110px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }
    .filter-label {
        font-family: 'Outfit', sans-serif;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 800;
        color: var(--agro-forest);
        margin-bottom: 20px;
        display: block;
    }
    .filter-link {
        display: flex;
        align-items: center;
        padding: 10px 12px;
        color: var(--text-slate);
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: 0.3s;
        border-radius: 12px;
        margin-bottom: 5px;
    }
    .filter-link:hover {
        background: var(--agro-mint);
        color: var(--agro-leaf);
    }
    .filter-link.active { 
        background: var(--agro-leaf);
        color: white;
        font-weight: 700;
    }

    /* Advanced Produce Cards */
    .agro-card {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 30px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
    }
    .agro-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 40px rgba(27, 67, 50, 0.12);
        border-color: var(--agro-leaf);
    }
    
    /* Image Container */
    .img-box {
        height: 250px;
        padding: 20px;
        background: #fdfdfd;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .img-box img {
        max-height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 20px;
        transition: transform 0.6s ease;
    }
    .agro-card:hover .img-box img { transform: scale(1.1); }

    /* Traceability Badge */
    .trace-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        color: var(--agro-leaf);
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 800;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .produce-info { padding: 25px; text-align: center; }
    .cat-tag {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--agro-leaf);
        background: var(--agro-mint);
        padding: 4px 12px;
        border-radius: 50px;
        font-weight: 700;
        margin-bottom: 12px;
        display: inline-block;
    }
    .produce-name {
        font-family: 'Outfit', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--agro-forest);
        margin-bottom: 8px;
    }
    .produce-price {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--agro-sun);
        margin-bottom: 20px;
    }

    /* Action Button */
    .btn-market {
        background: var(--agro-forest);
        color: white;
        border-radius: 15px;
        padding: 12px 30px;
        font-size: 0.9rem;
        font-weight: 700;
        transition: 0.4s;
        border: none;
        width: 100%;
    }
    .btn-market:hover {
        background: var(--agro-sun);
        color: white;
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(255, 159, 28, 0.3);
    }

    .empty-state { padding: 100px 0; text-align: center; }
    .empty-state i { color: var(--agro-mint); font-size: 4rem; margin-bottom: 20px; }
</style>

<div class="gallery-header container">
    <h1>Organic Marketplace</h1>
    <div class="leaf-divider"><i class="fas fa-seedling"></i></div>
    <p class="text-muted">Pure from the soil, delivered to your soul.</p>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="filter-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="filter-label mb-0">Harvest Categories</span>
                    <a href="product.php" class="text-muted small text-decoration-none">Reset</a>
                </div>
                
                <nav>
                    <?php
                    $res1 = mysqli_query($con, "SELECT * FROM category_product");
                    while($r1 = mysqli_fetch_array($res1)) {
                        $active = ($cid == $r1[0]) ? 'active' : '';
                        $url = "product.php?cid=".$r1[0].($price_filter ? "&price=$price_filter" : "");
                        echo "<a href='$url' class='filter-link $active'><i class='fas fa-leaf small me-2 opacity-50'></i>".ucfirst($r1[1])."</a>";
                    }
                    ?>
                </nav> 
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row g-4">
                <?php
                $res2 = mysqli_query($con, $query);
                if(mysqli_num_rows($res2) > 0) {
                    while($r2 = mysqli_fetch_array($res2)) {
                        ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="agro-card">
                               
                                <div class="img-box">
                                    <img src="<?php echo $r2[6]; ?>" alt="<?php echo $r2[1]; ?>" onerror="this.src='https://images.unsplash.com/photo-1610348725531-843dff563e2c?auto=format&fit=crop&w=400&q=80';">
                                </div>
                                <div class="produce-info">
                                    <span class="cat-tag"><?php echo $r2['category_name']; ?></span>
                                    <h5 class="produce-name"><?php echo $r2[1]; ?></h5>
                                    <div class="produce-price">₹<?php echo number_format($r2[4]); ?></div>
                                    <a href="product_detail.php?pid=<?php echo $r2[0]; ?>" class="btn btn-market">
                                        View Harvest Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-12 empty-state">
                        <i class="fas fa-cloud-sun"></i>
                        <h4 class="fw-bold">No Produce Found</h4>
                        <p class="text-muted">Try adjusting your filters to find the perfect organic match.</p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>