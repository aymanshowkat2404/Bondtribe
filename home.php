<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekend Activities | BONDTRIBE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #FF6B95;
            --secondary: #FF8E53;
            --accent: #FF9A8B;
            --light: #f5f7fa;
            --dark: #333;
            --gray: #666;
        }
        
        /* Main Layout Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--dark);
            line-height: 1.6;
        }
        
        /* Vibrant Header */
        header {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 50%, var(--secondary) 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 100;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        h1 {
            margin: 0;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        
        nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 1.5rem;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: white;
            transition: width 0.3s ease;
        }
        
        nav a:hover::after {
            width: 70%;
        }
        
        /* Main Content Box */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
        }
        
        .content-box {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 3rem;
            max-width: 1200px;
            width: 90%;
            margin: 2rem 0;
            overflow: hidden;
        }
        
        /* About Section with Image */
        .about-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 4rem;
            align-items: center;
        }
        
        .about-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
        }
        
        .about-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,154,139,0.1) 0%, rgba(255,107,149,0.1) 50%, rgba(255,142,83,0.1) 100%);
            z-index: 1;
        }
        
        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }
        
        .about-image:hover img {
            transform: scale(1.05);
        }
        
        /* Video Gallery Section */
        .video-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin: 3rem 0 1rem;
        }
        
        .video-item {
            transition: all 0.3s ease;
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .video-container:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .video-caption {
            text-align: center;
            margin-top: 15px;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.2rem;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--light) 0%, #e4e8f0 100%);
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .video-item:hover .video-caption {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }
        
        /* Interactive About Us Section */
        .about-section {
            background: linear-gradient(135deg, var(--light) 0%, #e4e8f0 100%);
            border-radius: 12px;
            padding: 2.5rem;
            border-left: 6px solid var(--primary);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .about-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 107, 149, 0.1);
        }
        
        .about-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="%23FF6B95" opacity="0.05"><circle cx="25" cy="25" r="5"/><circle cx="75" cy="75" r="5"/><circle cx="75" cy="25" r="5"/><circle cx="25" cy="75" r="5"/></svg>');
            z-index: 0;
        }
        
        .about-content {
            position: relative;
            z-index: 1;
        }
        
        .about-content h3 {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        .about-content h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 3px;
        }
        
        .about-content p {
            margin-bottom: 1.2rem;
            color: var(--gray);
        }
        
        .cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 0.9rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 1rem;
            box-shadow: 0 5px 15px rgba(255, 107, 149, 0.3);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }
        
        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        
        .cta-button:hover::before {
            left: 100%;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 107, 149, 0.4);
        }
        
        /* Vibrant Footer */
        footer {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 50%, var(--secondary) 100%);
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: auto;
        }
        
        footer p {
            margin: 0;
            font-size: 1rem;
            font-weight: 400;
            letter-spacing: 0.5px;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo {
            height: 50px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        
        .hero-section {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .hero-section h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }
        
        .hero-section p {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }
        
        /* Activity Heading */
        .activity-heading {
            text-align: center;
            color: var(--primary);
            margin: 2rem 0 3rem;
            font-size: 2rem;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
            font-weight: 600;
        }
        
        .activity-heading::after {
            content: "";
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--primary), var(--secondary));
            border-radius: 3px;
        }
        
        /* Floating Particles */
        .particle {
            position: absolute;
            background: rgba(255, 107, 149, 0.15);
            border-radius: 50%;
            pointer-events: none;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            nav ul {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .content-box {
                padding: 2rem 1.5rem;
            }
            
            .logo {
                height: 45px;
            }
            
            .hero-section h2 {
                font-size: 2.2rem;
            }
            
            .hero-section p {
                font-size: 1.1rem;
            }
            
            .video-gallery {
                grid-template-columns: 1fr;
            }
            
            .about-container {
                grid-template-columns: 1fr;
            }
            
            .about-image {
                order: -1;
                height: 300px;
            }
            
            .activity-heading {
                font-size: 1.6rem;
                margin: 1rem 0 2rem;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-content">
        <div class="logo-container">
            <img src="https://i.ibb.co/5KX5b0H/bondtribe-logo.png" alt="BONDTRIBE Logo" class="logo">
            <h1>BONDTRIBE</h1>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="register.php">Join Club</a></li>
                <li><a href="activities.php">Connect</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="main-container">
    <div class="content-box">
        <section>
            <div class="hero-section">
                <h2>Discover Your Weekend Tribe</h2>
                <p>Find fun activities to do on weekends with like-minded people. From music jams to hiking adventures, we've got something for everyone!</p>
            </div>
            
            <!-- About Section with Image -->
            <div class="about-container">
                <div class="about-section">
                    <div class="about-content">
                        <h3>About BONDTRIBE</h3>
                        <p>We're a vibrant community of adventure-seekers, creatives, and fun-lovers who believe weekends should be extraordinary.</p>
                        <p>Our mission is to help people break out of their routines, try new experiences, and form meaningful connections through shared activities. Whether you're looking for adventure partners, creative collaborators, or just new friends, you'll find your tribe here.</p>
                        <a href="register.php" class="cta-button">
                            Join Our Community <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="People enjoying outdoor activities">
                </div>
            </div>
            
            <!-- Video Gallery Section -->
            <h3 class="activity-heading">Our Community Activities</h3>
            <div class="video-gallery">
                <!-- Video 1 -->
                <div class="video-item">
                    <div class="video-container">
                        <video autoplay loop muted playsinline>
                            <source src="videos/music.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <p class="video-caption">🎵 Music Jam Sessions</p>
                </div>
                
                <!-- Video 2 -->
                <div class="video-item">
                    <div class="video-container">
                        <video autoplay loop muted playsinline>
                            <source src="videos/book.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <p class="video-caption">📚 Book Club Gatherings</p>
                </div>
                
                <!-- Video 3 -->
                <div class="video-item">
                    <div class="video-container">
                        <video autoplay loop muted playsinline>
                            <source src="videos/travelling.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <p class="video-caption">✈️ Group Travel Adventures</p>
                </div>
                
                <!-- Video 4 -->
                <div class="video-item">
                    <div class="video-container">
                        <video autoplay loop muted playsinline>
                            <source src="videos/yoga.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <p class="video-caption">🧘 Yoga Club</p>
                </div>
                
                <!-- Video 5 -->
                <div class="video-item">
                    <div class="video-container">
                        <video autoplay loop muted playsinline>
                            <source src="videos/cooking.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <p class="video-caption">👩‍🍳 Cooking Sessions</p>
                </div>
                
                <!-- Video 6 -->
                <div class="video-item">
                    <div class="video-container">
                        <video autoplay loop muted playsinline>
                            <source src="videos/hiking.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <p class="video-caption">🥾 Hiking Adventures</p>
                </div>
            </div>
        </section>
    </div>
</main>

<footer>
    <p>© 2024 BONDTRIBE | Connect Through Shared Passions</p>
</footer>

<script>
    // Create floating particles
    document.addEventListener('DOMContentLoaded', function() {
        const colors = ['rgba(255, 107, 149, 0.15)', 'rgba(255, 142, 83, 0.15)', 'rgba(255, 154, 139, 0.15)'];
        const container = document.querySelector('.content-box');
        
        for (let i = 0; i < 15; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random properties
            const size = Math.random() * 20 + 5;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const color = colors[Math.floor(Math.random() * colors.length)];
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.background = color;
            particle.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
            
            container.appendChild(particle);
        }
    });
</script>

</body>
</html>
