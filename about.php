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
        --soft-earth: #f1f5f2;
    }

    body { 
        background-color: #ffffff; 
        font-family: 'Public Sans', sans-serif; 
    }

    /* Modern Agri-Tech Header */
    .about-header {
        padding: 8rem 0 5rem 0;
        background: linear-gradient(rgba(27, 67, 50, 0.9), rgba(27, 67, 50, 0.9)), 
                    url('https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
        clip-path: ellipse(150% 100% at 50% 0%);
    }

    .about-header h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 4rem;
        font-weight: 800;
        letter-spacing: -2px;
    }

    /* 3D Visual Stack - Perfectly Aligned */
    .about-img-wrapper {
        position: relative;
        perspective: 1000px;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .about-img-wrapper img {
        width: 100%;
        height: auto;
        border-radius: 30px;
        transform: rotateY(-10deg);
        box-shadow: -20px 20px 50px rgba(0,0,0,0.1);
        transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        border: 8px solid white;
    }

    .about-img-wrapper:hover img {
        transform: rotateY(0deg) scale(1.02);
        box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    }

    .agro-quote {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 2.2rem;
        color: var(--agro-leaf);
        border-left: 8px solid var(--agro-sun);
        padding-left: 25px;
        margin-bottom: 2rem;
        line-height: 1.2;
    }

    .about-text {
        color: #475569;
        line-height: 1.9;
        font-size: 1.15rem;
        text-align: justify;
    }

    /* FULL SCREEN FEATURE BARS */
    .features-full-width {
        background: var(--soft-earth);
        padding: 80px 0;
        margin-top: 4rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        padding: 2.5rem;
        border-radius: 25px;
        background: white;
        transition: 0.4s;
        border: 1px solid #e2e8f0;
        height: 100%; /* Ensures all bars are equal height */
    }

    .feature-item:hover {
        border-color: var(--agro-mint);
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
    }

    .feature-icon {
        min-width: 70px;
        height: 70px;
        background: var(--agro-forest);
        color: var(--agro-sun);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        margin-right: 25px;
        font-size: 1.8rem;
    }

    .feature-content h6 {
        font-weight: 800;
        color: var(--agro-forest);
        margin-bottom: 8px;
        font-size: 1.25rem;
        font-family: 'Outfit', sans-serif;
    }

    .feature-content p {
        font-size: 1rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }

    .section-divider {
        width: 100px;
        height: 5px;
        background: linear-gradient(to right, var(--agro-sun), transparent);
        margin: 2.5rem 0;
        border-radius: 50px;
    }
</style>

<div class="about-header text-center shadow-lg">
    <div class="container animate__animated animate__fadeInDown">
        <h2 class="mb-3">Our Roots</h2>
        <p class="text-uppercase fw-bold opacity-75" style="letter-spacing: 5px; font-size: 0.8rem;">The Transparent Legacy of AgroTrace</p>
    </div>
</div>

<div class="container my-5 pt-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <div class="about-img-wrapper animate__animated animate__zoomIn">
                <img src="https://i.pinimg.com/originals/82/b4/f4/82b4f4b6ad9f626c24a770a5e15d031c.gif" alt="Farming Animation">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ps-lg-4">
                <div class="agro-quote animate__animated animate__fadeInRight">
                    "From Local Fields to Your Table, with Zero Secrets."
                </div>
                
                <p class="about-text">
                    At <strong>AgroTrace</strong>, we believe that food is more than just sustenance — it is a story of soil, health, and heritage. We leverage blockchain-inspired traceability to ensure that every fruit, vegetable, and grain you purchase is 100% organic and ethically sourced. Our mission is to bridge the gap between rural farmers and urban families, fostering a community built on transparency and pure quality.
                </p>
                <div class="section-divider"></div>
            </div>
        </div>
    </div>
</div>

<section class="features-full-width">
    <div class="container-fluid px-5">
        <div class="row g-4">
            <div class="col-xl-4 col-md-6">
                <div class="feature-item animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="feature-icon"><i class="fas fa-qrcode"></i></div>
                    <div class="feature-content">
                        <h6>Blockchain Traceability</h6>
                        <p>Scan any produce to trace its journey from the exact plot of land to your kitchen, including soil health and harvest date.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="feature-item animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="feature-icon"><i class="fas fa-tractor"></i></div>
                    <div class="feature-content">
                        <h6>Direct Farmer Connect</h6>
                        <p>We remove middlemen, ensuring our verified farmers earn 100% of their fair value while you get the freshest harvest.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-12">
                <div class="feature-item animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="feature-icon"><i class="fas fa-vial"></i></div>
                    <div class="feature-content">
                        <h6>Pesticide-Free Guarantee</h6>
                        <p>Regular lab-testing ensures that our products are free from harmful chemicals, meeting the highest organic certification standards.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>