<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .admin-footer {
        background: #1b4332; /* Deep Forest Green - Matches the AgroTrace Theme */
        color: #ffffff;
        padding: 40px 0 20px 0;
        margin-top: 80px;
        border-top: 4px solid #95d5b2; /* Fresh Mint Border */
    }

    .footer-brand {
        font-family: 'Outfit', sans-serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #95d5b2; /* Fresh Mint accent */
        letter-spacing: -0.5px;
    }

    .developer-tag {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 12px;
        display: block;
    }

    .developer-names {
        font-family: 'Public Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        color: #d1fae5; /* Very light mint for readability */
    }

    .footer-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 25px 0;
    }

    .copyright-text {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: #ff9f1c; /* Sun-ripened Orange hover effect */
    }
</style>

<footer class="admin-footer">
    <div class="container text-center">
        <div class="mb-4">
            <h5 class="footer-brand">
                <i class="fas fa-leaf mr-2"></i> AgroTrace 
            </h5>
            <small class="text-white-50">Transparent Organic Marketplace</small>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <span class="developer-tag">Cultivated By</span>
                <p class="developer-names">
                    Prince Solanki <span class="mx-2" style="color:#ff9f1c;">|</span> 
                    Tushar Roy <span class="mx-2" style="color:#ff9f1c;">|</span> 
                    Viraj Desai
                </p>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
            <p class="copyright-text mb-0">
                &copy; 2026 AgroTrace Marketplace. Empowering Local Farmers.
            </p>
            <div class="mt-2 mt-md-0">
                <a href="#" class="footer-link small mx-2">System Status</a>
                <a href="contact.php" class="footer-link small mx-2">Farmer Support</a>
            </div>
        </div>
    </div>
</footer>

<script src="assets/js/jquery-2.2.3.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>