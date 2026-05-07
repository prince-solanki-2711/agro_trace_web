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
        --glass: rgba(255, 255, 255, 0.9);
    }

    body { 
        background-color: #ffffff; 
        font-family: 'Public Sans', sans-serif; 
    }

    /* Modern Agri-Tech Header */
    .contact-header {
        padding: 7rem 0 5rem 0;
        background: linear-gradient(rgba(27, 67, 50, 0.8), rgba(27, 67, 50, 0.8)), 
                    url('https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
        clip-path: ellipse(150% 100% at 50% 0%);
    }

    .contact-header h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 3.8rem;
        font-weight: 800;
        letter-spacing: -2px;
    }

    /* Advanced Glassmorphism Info Cards */
    .info-card {
        padding: 3.5rem 2rem;
        text-align: center;
        border-radius: 30px;
        background: var(--glass);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .info-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 60px rgba(27, 67, 50, 0.15);
        border-color: var(--agro-mint);
    }

    .icon-wrapper {
        width: 75px;
        height: 75px;
        background-color: var(--agro-forest);
        color: var(--agro-sun);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 22px;
        margin-bottom: 2rem;
        font-size: 1.8rem;
        box-shadow: 0 10px 20px rgba(27, 67, 50, 0.2);
        transition: 0.4s;
    }

    .info-card:hover .icon-wrapper {
        transform: rotate(360deg);
        background-color: var(--agro-sun);
        color: white;
    }

    .info-card h5 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        color: var(--agro-forest);
    }

    .info-card p {
        color: #475569;
        line-height: 1.9;
        font-size: 1rem;
        margin-bottom: 0;
    }

    .contact-link {
        color: var(--agro-forest);
        text-decoration: none;
        font-weight: 700;
        transition: color 0.3s;
    }

    .contact-link:hover {
        color: var(--agro-sun);
    }

    /* Map & GIF Section */
    .map-container {
        border-radius: 40px;
        overflow: hidden;
        border: 10px solid white;
        margin-top: 4rem;
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
    }

    .floating-gif-container {
        position: relative;
        margin-top: -60px;
        z-index: 5;
        text-align: center;
    }

    .support-gif {
        width: 280px;
        border-radius: 30px;
        border: 8px solid white;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        animation: floatAnim 4s ease-in-out infinite;
    }

    @keyframes floatAnim {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>

<div class="contact-header text-center">
    <div class="container animate__animated animate__fadeInDown">
        <h2>Connect With Us</h2>
        <p class="text-uppercase fw-bold opacity-75" style="letter-spacing: 5px; font-size: 0.8rem;">Transparent Support for Organic Living</p>
    </div>
</div>

<div class="container mb-5">
    <div class="floating-gif-container">
        <img src="https://cdn.dribbble.com/userupload/21761290/file/original-d02f00f5813abafc8cc2c6d311efd205.gif" class="support-gif" alt="AgroTrace Support">
    </div>

    <div class="row g-5 justify-content-center mt-2">
        <div class="col-lg-4 col-md-6">
            <div class="info-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="icon-wrapper">
                    <i class="fas fa-seedling"></i>
                </div>
                <h5>Market HQ</h5>
                <p>
                    <strong>AgroTrace Marketplace</strong><br>
                    Plot 45, Green Tech Park,<br>
                    Iscon-Ambli Road, Ahmedabad,<br>
                    Gujarat 380058, India
                </p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="info-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="icon-wrapper">
                    <i class="fas fa-headset"></i>
                </div>
                <h5>Farmer & Buyer Help</h5>
                <p>
                    Market Hotline:<br>
                    <a href="tel:+919825012345" class="contact-link">+91 98250 12345</a><br><br>
                    Logistics Support:<br>
                    <a href="tel:+919876543210" class="contact-link">+91 98765 43210</a>
                </p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="info-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="icon-wrapper">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h5>Digital Support</h5>
                <p>
                    General Inquiries:<br>
                    <a href="mailto:info@agrotrace.in" class="contact-link">info@agrotrace.in</a><br><br>
                    Order Tracking:<br>
                    <a href="mailto:support@agrotrace.in" class="contact-link">support@agrotrace.in</a>
                </p>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="map-container animate__animated animate__fadeIn">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.933221976092!2d72.5020108759082!3d23.026190816223292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b3a0b81893d%3A0xc3f8e58a74b09c85!2sIscon%20Mega%20Mall!5e0!3m2!1sen!2sin!4v1709123456789!5m2!1sen!2sin" 
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>