<?php
// Step 1: Database Connection
$conn = new mysqli('localhost', 'root', '', 'neetcodb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch Dynamic Content (editable part for about.php)
$page_content = "Welcome to NEET Advisor! We guide you towards your dream career in medical education.";  // Default content if no DB entry exists.

$sql = "SELECT content FROM content WHERE page='about.php'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $page_content = $row['content'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - NEET Advisor</title>
    <link rel="stylesheet" href="about.css">
</head>
<body>

<!-- About Section -->
<section id="about">
    <div class="about-container">
        <div class="about-content">
            <div class="about-image">
                <img src="project1 image/About-Us-Pic-1.webp" alt="Team Discussion">
            </div>
            <div class="about-text">
                <h2>
                    <span class="highlight-yellow">Guiding</span> you towards your 
                    <span class="highlight-bold">DREAM CAREER</span>
                </h2>

                <!-- ✅ Editable Content from Database (this is where admin changes will show) -->
                <div class="editable-content">
                    <?php echo $page_content; ?>
                </div>

                <!-- Static (non-editable) part — this won't come from DB -->
                <p>
                    Our innovative offerings have been exclusively designed for NEET UG and NEET PG aspirants. Our programs are like having your own personal coach who will empower you with all the important aspects of NEET counselling, playing a crucial role in getting a medical seat even at a low NEET score through smart counselling.
                </p>
            </div>
        </div>
    </div>

    <div class="vision-mission">
        <h2><span class="highlight-yellow">Vision</span> & <span class="highlight-bold">Mission</span></h2>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision-section">
    <div class="mission">
        <h2 class="heading">Mission</h2>
        <p>
            To empower medical students to make lifelong, responsible, and meaningful choices in a global and dynamic world. We will accomplish this by building personal relationships in a professional yet helping environment.
        </p>
    </div>

    <div class="paper-plane">
        <img src="project1 image/plane.png" alt="Paper Plane">
    </div>

    <div class="vision">
        <h2 class="heading">Vision</h2>
        <p>
            Be the most preferred choice for the medical students who are goal-oriented, determined and wish to pursue medical education without any obstacles.
        </p>
    </div>
</section>

<!-- Core Values Section -->
<section class="core-values">
    <h2 class="section-title">Our Core Values</h2>
    <div class="values-container">
        <div class="values-column">
            <p>✔ Transparency</p>
            <p>✔ Commitment</p>
            <p>✔ Collaboration</p>
        </div>
        <div class="values-column">
            <p>✔ Quality</p>
            <p>✔ Integrity</p>
            <p>✔ Excellence</p>
        </div>
        <div class="values-column">
            <p>✔ Team work</p>
            <p>✔ Creativity</p>
            <p>✔ Knowledge</p>
        </div>
    </div>
</section>

<!-- Team In Action Section -->
<section class="team-action">
    <h2 class="team-heading">Team In Action</h2>
</section>

<!-- About Team Section -->
<section class="about-section">
    <p class="about-text">
        We are a team of young professionals dedicated to equip students with the clarity, courage, and determination to follow their dreams...
    </p>
</section>

<!-- Gems of NEET Advisor Section -->
<section class="team-section">
    <h2 class="section-title">Gems of <span class="highlight">NEET Advisor</span></h2>
    <div class="team-container">
        <div class="team-member">
            <div class="image-container">
                <img src="project1 image/advisor 1.jpg" alt="Vipin Bansal">
            </div>
            <h3 class="name">Vipin Bansal</h3>
            <p class="role">Founder & CEO</p>
            <div class="social-icons">
                <a href="#"><span class="icon">f</span></a>
                <a href="#"><span class="icon">in</span></a>
            </div>
            <div class="underline"></div>
        </div>

        <div class="team-member">
            <div class="image-container">
                <img src="project1 image/advisor 2.jpg" alt="Vivek Singh">
            </div>
            <h3 class="name">Vivek Singh</h3>
            <p class="role">Co-founder</p>
            <div class="social-icons">
                <a href="#"><span class="icon">f</span></a>
                <a href="#"><span class="icon">in</span></a>
            </div>
            <div class="underline"></div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="project1 image/logo.png" alt="NEET Advisor">
        </div>
        <div class="footer-links">
            <h3>Useful Links</h3>
            <ul>
                <li>✔ Neet Guide</li>
                <li>✔ Gallery</li>
                <li>✔ About us</li>
            </ul>
        </div>
        <div class="footer-contact">
            <h3>Contact</h3>
            <p>📞 +91-991-120-3280</p>
            <p>📍 US 1 & 2, Ground Floor, U.S. Complex, Jasola, Delhi-110076</p>
            <p>📍 No. 810, B Wing, Kanakia Wall Street, Andheri East, Mumbai-400093</p>
        </div>
        <div class="footer-follow">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <img src="project1 image/insta-Photoroom.png" alt="Instagram">
                <img src="project1 image/linked in-Photoroom.png" alt="LinkedIn">
                <img src="project1 image/youtube-Photoroom.png" alt="YouTube">
                <img src="project1 image/facebook.png" alt="Facebook">
            </div>
            <input type="email" placeholder="Your Email">
            <button class="subscribe-btn">Subscribe</button>
        </div>
    </div>

    <div class="footer-bottom">
        <p>All Rights Reserved Copyright NEET Advisor © 2024</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms & Refund Policy</a> | <a href="#">Sitemap</a></p>
    </div>
</footer>

</body>
</html>
