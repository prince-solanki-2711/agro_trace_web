AgroTrace - Blockchain-Inspired Organic Marketplace
AgroTrace is a transparent, direct-to-consumer agri-tech platform designed to bridge the gap between local farmers and urban consumers. The platform leverages a modern web interface to provide a marketplace for 100% organic, lab-tested, and ethically sourced produce, focusing on traceability and fair value for farmers.

🌟 Key Features
Direct Farmer-to-Consumer Connection: Eliminates middlemen, ensuring farmers receive 100% of their fair market value.

Blockchain-Inspired Traceability: Highlights the journey of produce from the specific plot of land to the consumer's kitchen.

Dual Dashboard System:

Admin Console: For managing overall inventory, verifying farmer statuses, tracking market sales, and handling financial settlements.

Farmer (Supplier) Portal: Enables farmers to list new harvest items (vegetables, fruits, grains, etc.), track their specific revenue, and view sales logistics.

Diverse Product Categories: Supports fresh vegetables, fruits, grains, pulses, and spices.

Modern Responsive UI: Built with a "Glassmorphism" aesthetic, featuring a cinematic hero section and mobile-friendly layouts.

🛠️ Tech Stack
Backend: PHP (7.4+)

Database: MySQL

Frontend:

HTML5 & CSS3 (Custom Glassmorphism styling)

Bootstrap (for responsive design)

Animate.css & FontAwesome 6.4.0

Google Fonts (Outfit & Public Sans)

🗄️ Database Structure
The project uses a relational database named agro_trace with the following key tables:

farmer_detail: Stores farmer profiles and verification status (e.g., "Verified").

customer_detail: Manages consumer accounts and contact information.

product_detail: Tracks inventory, including product descriptions, prices, units (kg, dozen, etc.), and the associated farmer ID.

order_detail & cart_detail: Manages the sales cycle from carting to finalized orders and amounts.

category_product: Categorizes items into groups like "Fresh Vegetables" or "Grains".

🚀 Installation & Setup
Clone the repository:

Bash
git clone https://github.com/your-username/agro-trace.git
Database Setup:

Open PHPMyAdmin or your preferred MySQL client.

Create a new database named agro_trace.

Import the agro_trace.sql file provided in the repository.

Configure Connection:

Open connect.php.

Update the database credentials (host, username, password) to match your local environment.

PHP
$con = mysqli_connect("localhost", "root", "your_password", "agro_trace");
Run the Project:

Move the project folder to your local server directory (e.g., htdocs for XAMPP).

Access the site via http://localhost/agro_trace_web/index.php.

📂 Project Organization
/admin_...: Files related to the administrative backend.

/supplier_...: Files related to the farmer/supplier portal.

/perfume_img/: Directory used for storing product images (Note: Inherited folder name from original template).

header.php / footer.php: Global layout components.

🛡️ License
This project is developed for educational and professional demonstration purposes, focusing on improving transparency in the agricultural supply chain.
