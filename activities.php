<?php
session_start();
require 'db.php';

$logged_in = isset($_SESSION['user_id']);
$user_club = $logged_in ? $_SESSION['user_club'] : '';
$member_count = 42; // Example data - replace with actual query
$upcoming_events = 3; // Example data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect | BONDTRIBE</title>
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
            --sparkle: rgba(255, 255, 255, 0.8);
        }
        
        /* Animation Keyframes */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
        }
        
        @keyframes sparkle {
            0% { transform: scale(0) rotate(0deg); opacity: 0; }
            50% { transform: scale(1.2) rotate(180deg); opacity: 1; }
            100% { transform: scale(0) rotate(360deg); opacity: 0; }
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Main Styles */
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
            overflow-x: hidden;
        }
        
        /* Vibrant Animated Header */
        header {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 50%, var(--secondary) 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
            color: white;
            padding: 1rem 0;
            position: relative;
            z-index: 100;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
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
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        /* Navigation with Hover Effects */
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
            overflow: hidden;
        }
        
        nav a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: white;
            transition: width 0.3s ease;
        }
        
        nav a:hover::before {
            width: 100%;
        }
        
        /* Hero Banner with Floating Elements */
        .welcome-banner {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 50%, var(--secondary) 100%);
            background-size: 200% 200%;
            animation: gradientShift 10s ease infinite;
            color: white;
            padding: 5rem 1rem;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }
        
        .welcome-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="%23ffffff" opacity="0.05"><circle cx="25" cy="25" r="5"/><circle cx="75" cy="75" r="5"/><circle cx="75" cy="25" r="5"/><circle cx="25" cy="75" r="5"/></svg>');
            z-index: 0;
        }
        
        .welcome-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeIn 1s ease;
        }
        
        .welcome-banner h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, white 0%, #f5f5f5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: none;
            animation: pulse 3s ease infinite;
        }
        
        .welcome-banner p {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            animation: fadeIn 1.5s ease;
        }
        
        /* Floating Shapes */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            filter: blur(1px);
            z-index: 0;
            animation: float 15s ease-in-out infinite;
        }
        
        /* Main Content */
        .main-container {
            flex: 1;
            max-width: 1200px;
            margin: -3rem auto 0;
            padding: 0 20px;
            width: 100%;
            box-sizing: border-box;
            position: relative;
            z-index: 2;
        }
        
        /* Glowing Content Cards */
        .content-box {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .content-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(255, 107, 149, 0.2);
        }
        
        .content-box::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: -1;
        }
        
        /* Section Titles */
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .section-title h2 {
            font-size: 1.8rem;
            color: var(--primary);
            margin: 0;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .section-title h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 3px;
        }
        
        /* Interactive Action Cards */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
        }
        
        .action-card {
            background: white;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 107, 149, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .action-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,107,149,0.03) 0%, rgba(255,142,83,0.03) 100%);
            z-index: 0;
        }
        
        .action-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255, 107, 149, 0.15);
        }
        
        .action-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--light) 0%, #e4e8f0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary);
            font-size: 1.8rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .action-card:hover .action-icon {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            transform: rotate(15deg);
        }
        
        .action-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .action-desc {
            color: var(--gray);
            font-size: 0.95rem;
            position: relative;
            z-index: 1;
        }
        
        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 107, 149, 0.1);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            line-height: 1;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Sparkle Button */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(255, 107, 149, 0.3);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            gap: 10px;
            position: relative;
            overflow: hidden;
            font-size: 1.1rem;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 30px rgba(255, 107, 149, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
            box-shadow: none;
        }
        
        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        /* Sparkle Effect */
        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--sparkle);
            border-radius: 50%;
            pointer-events: none;
            animation: sparkle 1s ease-out forwards;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 50%, var(--secondary) 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
            clip-path: polygon(0 20%, 100% 0, 100% 100%, 0% 100%);
            position: relative;
        }
        
        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="%23ffffff" opacity="0.05"><circle cx="25" cy="25" r="5"/><circle cx="75" cy="75" r="5"/><circle cx="75" cy="25" r="5"/><circle cx="25" cy="75" r="5"/></svg>');
            z-index: 0;
        }
        
        footer p {
            margin: 0;
            font-size: 1rem;
            font-weight: 400;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }
        
        /* Logo Styles */
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo {
            height: 50px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: rotate(-5deg) scale(1.1);
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
            
            .welcome-banner {
                padding: 3rem 1rem;
                clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
            }
            
            .welcome-banner h1 {
                font-size: 2.2rem;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .logo {
                height: 45px;
            }
            
            footer {
                clip-path: polygon(0 10%, 100% 0, 100% 100%, 0% 100%);
            }
        }
        
        /* Fade-in Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease forwards;
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

<!-- Floating background shapes -->
<div class="floating-shape" style="width: 150px; height: 150px; background: var(--primary); top: 10%; left: 5%; animation-delay: 0s;"></div>
<div class="floating-shape" style="width: 80px; height: 80px; background: var(--secondary); top: 60%; left: 80%; animation-delay: 2s;"></div>
<div class="floating-shape" style="width: 100px; height: 100px; background: var(--accent); top: 30%; left: 70%; animation-delay: 4s;"></div>

<div class="welcome-banner">
    <div class="welcome-content">
        <h1>Welcome to Your <?php echo htmlspecialchars($user_club); ?> Tribe!</h1>
        <p>Connect with <?php echo $member_count; ?> like-minded people who share your passion</p>
        <button class="btn btn-outline" id="sparkle-btn">
            <i class="fas fa-rocket"></i> Get Started Guide
        </button>
    </div>
</div>

<div class="main-container">
    <div class="content-box fade-in" style="animation-delay: 0.2s;">
        <div class="content">
            <div class="section-title">
                <h2>Your Community</h2>
                <a href="club_events.php" class="view-all">
                    View All <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $member_count; ?></div>
                    <div class="stat-label">Tribe Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo $upcoming_events; ?></div>
                    <div class="stat-label">Upcoming Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Active Community</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-box fade-in" style="animation-delay: 0.4s;">
        <div class="content">
            <div class="section-title">
                <h2>Quick Actions</h2>
            </div>
            
            <div class="quick-actions">
                <div class="action-card" onclick="location.href='create_event.php'">
                    <div class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="action-title">Create Event</div>
                    <div class="action-desc">Organize your own gathering</div>
                </div>
                
                <div class="action-card" onclick="location.href='invite.php'">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="action-title">Invite Friends</div>
                    <div class="action-desc">Grow your community</div>
                </div>
                
                <div class="action-card" onclick="location.href='group_chat.php'">
                    <div class="action-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="action-title">Group Chat</div>
                    <div class="action-desc">Connect with members</div>
                </div>
                
                <div class="action-card" onclick="location.href='activities.php'">
                    <div class="action-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="action-title">View Events</div>
                    <div class="action-desc">See what's happening</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-box fade-in" style="animation-delay: 0.6s;">
        <div class="content">
            <div class="section-title">
                <h2>Upcoming Events</h2>
                <a href="club_events.php" class="view-all">
                    View All <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            
            <?php if ($upcoming_events > 0): ?>
                <!-- Event cards would go here -->
                <div style="text-align: center; padding: 2rem;">
                    <i class="fas fa-calendar-alt" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--dark); margin-bottom: 0.5rem;">Your events will show here</h3>
                    <p style="color: var(--gray);">Check back soon for upcoming <?php echo htmlspecialchars($user_club); ?> events!</p>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 2rem;">
                    <i class="fas fa-calendar-plus" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--dark); margin-bottom: 0.5rem;">No upcoming events yet</h3>
                    <p style="color: var(--gray); margin-bottom: 1.5rem;">Be the first to create an event for your tribe!</p>
                    <button class="btn" onclick="location.href='create_event.php'">
                        <i class="fas fa-plus"></i> Create Event
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer>
    <p>© 2024 BONDTRIBE | Connect Through Shared Passions</p>
</footer>

<script>
    // Sparkle button effect
    document.getElementById('sparkle-btn').addEventListener('click', function(e) {
        for (let i = 0; i < 10; i++) {
            createSparkle(e);
        }
    });
    
    function createSparkle(e) {
        const sparkle = document.createElement('div');
        sparkle.className = 'sparkle';
        
        // Position sparkle at click location
        const rect = e.target.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        sparkle.style.left = `${x}px`;
        sparkle.style.top = `${y}px`;
        
        // Random size and color variation
        const size = Math.random() * 10 + 5;
        sparkle.style.width = `${size}px`;
        sparkle.style.height = `${size}px`;
        
        // Add to button and remove after animation
        e.target.appendChild(sparkle);
        setTimeout(() => {
            sparkle.remove();
        }, 1000);
    }
    
    // Add hover effect to action cards
    document.querySelectorAll('.action-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 15px 30px rgba(255, 107, 149, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.08)';
        });
        
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'translateY(-10px)';
            }, 200);
        });
    });
    
    // Add floating shapes to background
    document.addEventListener('DOMContentLoaded', function() {
        const colors = ['var(--primary)', 'var(--secondary)', 'var(--accent)'];
        const container = document.body;
        
        for (let i = 0; i < 8; i++) {
            const shape = document.createElement('div');
            shape.className = 'floating-shape';
            
            // Random properties
            const size = Math.random() * 150 + 50;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const color = colors[Math.floor(Math.random() * colors.length)];
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            const blur = Math.random() * 5 + 2;
            
            shape.style.width = `${size}px`;
            shape.style.height = `${size}px`;
            shape.style.left = `${posX}%`;
            shape.style.top = `${posY}%`;
            shape.style.background = color;
            shape.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
            shape.style.filter = `blur(${blur}px)`;
            
            container.appendChild(shape);
        }
    });
</script>
</body>
</html>
