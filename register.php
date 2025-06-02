<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session at the VERY TOP
session_start();
// Include database connection
require 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's registration form
    if (isset($_POST['register'])) {
        // Validate and sanitize inputs
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $club = $conn->real_escape_string($_POST['club']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Set default interests based on club
        $interests = $club;

        // SQL query with prepared statement (recommended)
        $sql = "INSERT INTO users (name, email, club, password, interests) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $club, $password, $interests);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['user_club'] = $club;
            $success_message = "Registration successful! You can now <a href='activities.php'>select activities</a>.";
        } else {
            $error_message = "Error: " . $conn->error;
        }
        $stmt->close();
    }
    
    // Check if it's login form
    if (isset($_POST['login'])) {
        $email = $conn->real_escape_string($_POST['login_email']);
        $password = $_POST['login_password'];
        
        $sql = "SELECT id, name, club, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_club'] = $user['club'];
                $success_message = "Login successful! Welcome back, " . $user['name'] . ". <a href='activities.php'>View activities</a>.";
            } else {
                $error_message = "Invalid email or password";
            }
        } else {
            $error_message = "Invalid email or password";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join BONDTRIBE</title>
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
            padding: 3rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
            gap: 3rem;
            align-items: center;
        }
        
        /* Form Container Styles */
        .form-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        .form-container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .form-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="%23FF6B95" opacity="0.05"><circle cx="25" cy="25" r="5"/><circle cx="75" cy="75" r="5"/><circle cx="75" cy="25" r="5"/><circle cx="25" cy="75" r="5"/></svg>');
            z-index: 0;
        }
        
        .form-content {
            position: relative;
            z-index: 1;
        }
        
        .form-container h2 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .form-container h2::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 3px;
        }
        
        form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        label {
            font-weight: 500;
            color: var(--dark);
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 107, 149, 0.2);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.9rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(255, 107, 149, 0.3);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            gap: 8px;
            position: relative;
            overflow: hidden;
            font-size: 1rem;
            width: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 107, 149, 0.4);
        }
        
        /* Video Container */
        .video-container {
            flex: 1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .video-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,154,139,0.1) 0%, rgba(255,107,149,0.1) 50%, rgba(255,142,83,0.1) 100%);
            z-index: 1;
        }
        
        .video-container video {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Toggle between forms */
        .form-toggle {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .toggle-btn {
            background: none;
            border: none;
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            padding: 0.5rem 1rem;
            position: relative;
        }
        
        .toggle-btn.active {
            color: var(--primary);
        }
        
        .toggle-btn.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            height: 2px;
            background: var(--primary);
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
        
        /* Messages */
        .message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
        }
        
        .success-message {
            background-color: rgba(212, 237, 218, 0.8);
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error-message {
            background-color: rgba(248, 215, 218, 0.8);
            color: #721c24;
            border: 1px solid #f5c6cb;
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
            
            .main-container {
                flex-direction: column;
                padding: 2rem 1rem;
                gap: 2rem;
            }
            
            .form-container {
                padding: 1.5rem;
            }
            
            .logo {
                height: 45px;
            }
            
            .video-container {
                order: -1;
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
    <div class="video-container">
        <video autoplay loop muted playsinline>
            <source src="videos/login.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    
    <div class="form-section">
        <?php if (isset($success_message)): ?>
            <div class="message success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="message error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <div class="form-container" id="register-form">
            <div class="form-content">
                <h2>Create Account</h2>
                
                <form method="POST" action="register.php">
                    <input type="hidden" name="register" value="1">
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" required placeholder="Enter your full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" required placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                        <label for="club">Preferred Club</label>
                        <select name="club" id="club" required>
                            <option value="">Select a club</option>
                            <option value="Music">Music Club</option>
                            <option value="Book">Book Club</option>
                            <option value="Travel">Travel Club</option>
                            <option value="Yoga">Yoga Club</option>
                            <option value="Cooking">Cooking Club</option>
                            <option value="Hiking">Hiking Club</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required placeholder="Create a password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Register Now
                    </button>
                </form>
                
                <div class="form-toggle">
                    <button class="toggle-btn" onclick="showLoginForm()">Already have an account? Login</button>
                </div>
            </div>
        </div>
        
        <div class="form-container" id="login-form" style="display: none;">
            <div class="form-content">
                <h2>Welcome Back</h2>
                
                <form method="POST" action="register.php">
                    <input type="hidden" name="login" value="1">
                    
                    <div class="form-group">
                        <label for="login_email">Email Address</label>
                        <input type="email" name="login_email" id="login_email" required placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                        <label for="login_password">Password</label>
                        <input type="password" name="login_password" id="login_password" required placeholder="Enter your password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>
                
                <div class="form-toggle">
                    <button class="toggle-btn" onclick="showRegisterForm()">Don't have an account? Register</button>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    <p>© 2024 BONDTRIBE | Connect Through Shared Passions</p>
</footer>

<script>
    function showLoginForm() {
        document.getElementById('register-form').style.display = 'none';
        document.getElementById('login-form').style.display = 'block';
    }
    
    function showRegisterForm() {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('register-form').style.display = 'block';
    }
    
    // Show login form if there are errors in login
    <?php if (isset($_POST['login'])): ?>
        showLoginForm();
    <?php endif; ?>
</script>

</body>
</html>
