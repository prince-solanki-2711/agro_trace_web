<?php include("header.php"); ?>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Public+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --agro-forest: #1b4332;
        --agro-leaf: #2d6a4f;
        --agro-mint: #95d5b2;
        --agro-sun: #ff9f1c;
        --glass: rgba(255, 255, 255, 0.9);
    }

    body { 
        background-color: #fcfdfc; 
        font-family: 'Public Sans', sans-serif;
        overflow-x: hidden;
    }

    /* 1. Fixed Bug: Better Carousel Height & Responsive Styling */
    .hero-advanced {
        height: 85vh;
        margin-top: -20px;
        position: relative;
        overflow: hidden;
        clip-path: ellipse(150% 100% at 50% 0%);
    }

    .hero-advanced .carousel-item img {
        height: 85vh;
        object-fit: cover;
        filter: brightness(0.7);
    }

    /* 2. Cinematic Hero Overlay (Glassmorphism) */
    .hero-overlay {
        position: absolute;
        top: 50%;
        left: 8%;
        transform: translateY(-50%);
        z-index: 10;
        background: var(--glass);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 50px;
        border-radius: 40px;
        box-shadow: 0 40px 80px rgba(0,0,0,0.15);
        max-width: 650px;
        border: 1px solid rgba(255, 255, 255, 0.4);
    }

    /* 3. Visual 3D Stack */
    .visual-wrapper {
        position: relative;
        perspective: 2000px;
    }

    .dynamic-agro-gif {
        width: 100%;
        border-radius: 50px;
        transform: rotateY(-15deg) rotateX(5deg);
        transition: all 0.8s cubic-bezier(0.2, 1, 0.3, 1);
        box-shadow: -30px 40px 70px rgba(0,0,0,0.2);
        border: 10px solid #ffffff;
    }

    .visual-wrapper:hover .dynamic-agro-gif {
        transform: rotateY(0deg) rotateX(0deg) scale(1.05);
        box-shadow: 0 40px 80px rgba(0,0,0,0.3);
    }

    /* 4. Stats Counter Section */
    .stats-section {
        background: var(--agro-forest);
        color: white;
        padding: 60px 0;
        margin-top: -50px;
        position: relative;
        z-index: 11;
        border-radius: 30px;
        margin-left: 20px;
        margin-right: 20px;
    }

    .stat-card h2 { color: var(--agro-sun); font-weight: 800; font-family: 'Outfit'; }

    /* 5. Advanced Feature Boxes */
    .feature-box-advanced {
        background: #ffffff;
        border: 1px solid #edf2f7;
        padding: 30px;
        border-radius: 25px;
        margin-bottom: 20px;
        transition: 0.4s;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }

    .feature-box-advanced:hover {
        background: var(--agro-leaf);
        transform: translateX(15px);
        color: white !important;
    }

    .feature-box-advanced:hover h6, .feature-box-advanced:hover p { color: white !important; }

    .feature-icon-circle {
        min-width: 60px;
        height: 60px;
        background: var(--agro-mint);
        color: var(--agro-forest);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 25px;
    }

    .btn-harvest-cta {
        background: var(--agro-forest);
        color: #fff;
        font-weight: 800;
        padding: 18px 40px !important;
        border-radius: 20px;
        transition: 0.5s;
        border: none;
    }

    .btn-harvest-cta:hover {
        background: var(--agro-sun);
        color: white;
        transform: scale(1.05);
    }

    @media (max-width: 991px) {
        .hero-overlay { left: 5%; right: 5%; padding: 30px; top: 60%; }
        .hero-advanced { height: 70vh; }
    }
</style>

<div class="hero-advanced shadow-lg">
    <div class="hero-overlay animate__animated animate__fadeInLeft">
        <span class="badge bg-success rounded-pill px-3 py-2 mb-3 text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.7rem;">Verified Organic</span>
        <h1 class="display-3 fw-bold text-dark mb-3" style="font-family: 'Outfit';">Fresh Harvest.<br><span style="color: var(--agro-leaf);">Zero Secrets.</span></h1>
        <p class="lead text-muted mb-4">The world's first transparent marketplace connecting you directly to local farmers via blockchain traceability.</p>
        <a href="perfumes.php" class="btn btn-harvest-cta">Start Shopping <i class="fas fa-shopping-basket ms-2"></i></a>
    </div>

    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?auto=format&fit=crop&w=1920&q=80" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&fit=crop&w=1920&q=80" class="d-block w-100">
            </div>
        </div>
    </div>
</div>

<div class="container stats-section shadow">
    <div class="row text-center">
        <div class="col-md-4 stat-card">
            <h2>500+</h2>
            <p class="text-uppercase mb-0 small opacity-75">Verified Farmers</p>
        </div>
        <div class="col-md-4 stat-card border-start border-end border-secondary">
            <h2>12,000+</h2>
            <p class="text-uppercase mb-0 small opacity-75">Orders Delivered</p>
        </div>
        <div class="col-md-4 stat-card">
            <h2>100%</h2>
            <p class="text-uppercase mb-0 small opacity-75">Organic Certified</p>
        </div>
    </div>
</div>

<section class="py-5 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="visual-wrapper">
                    <div class="position-absolute bg-white p-3 rounded-circle shadow animate__animated animate__pulse animate__infinite" style="top: -20px; right: 20px; z-index: 10;">
                        <i class="fas fa-certificate text-warning fa-2x"></i>
                    </div>
                    <img src="https://i.pinimg.com/originals/ef/89/b5/ef89b595d7f9c5eb4be2bea8a770ce36.gif" class="dynamic-agro-gif shadow-lg" alt="Organic Farming">
                </div>
            </div>

            <div class="col-lg-7 ps-lg-5">
                <h2 class="display-5 fw-bold mb-4" style="color: var(--agro-forest); font-family: 'Outfit';">Bridging the Gap Between <span style="color: var(--agro-leaf);">Fields & Tables.</span></h2>
                <p class="text-secondary mb-5" style="line-height: 1.8;">We believe every purchase should empower a farmer. <strong>AgroTrace</strong> leverages modern technology to ensure your fruits, vegetables, and grains are 100% chemical-free and ethically sourced.</p>

                <div class="feature-box-advanced shadow-sm">
                    <div class="feature-icon-circle"><i class="fas fa-qrcode"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Blockchain Traceability</h6>
                        <p class="text-muted mb-0 small">Scan any product to view its entire farm-to-table journey.</p>
                    </div>
                </div>

                <div class="feature-box-advanced shadow-sm">
                    <div class="feature-icon-circle"><i class="fas fa-tractor"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Direct Farmer Portal</h6>
                        <p class="text-muted mb-0 small">Remove middlemen. Farmers earn 100% of their fair value.</p>
                    </div>
                </div>

                <div class="feature-box-advanced shadow-sm">
                    <div class="feature-icon-circle"><i class="fas fa-leaf"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Lab-Tested Purity</h6>
                        <p class="text-muted mb-0 small">Zero pesticides. Verified by global organic standards.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include("footer.php"); ?>