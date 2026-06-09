<?php
// ==========================================
// CONFIGURATION
// ==========================================
 $supabaseUrl = "https://gflakfgduibcppsaowao.supabase.co"; 
 $supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImdmbGFrZmdkdWliY3Bwc2Fvd2FvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NjI4OTYsImV4cCI6MjA5NjEzODg5Nn0.XvJ8hJgCkVDaQKeRkxM9meFhBD1a7gvyeqF29BYnAI0"; 

// Helper: Fetch Projects
function supabase_get_projects($url, $key) {
    $endpoint = $url . "/rest/v1/projects?order=created_at.desc";
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $key,
        "Authorization: Bearer " . $key,
        "Content-Type: application/json"
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response, true);
    return $decoded ?? [];
}

 $portfolioProjects = supabase_get_projects($supabaseUrl, $supabaseKey);
 $featuredProjects = array_slice($portfolioProjects, 0, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nikhil Honkalaskar | Full Stack Developer</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ORIGINAL CORE VARIABLES */
        :root {
            --bg-dark: #0B1120;
            --bg-card: rgba(30, 41, 59, 0.7);
            --primary: #38BDF8;
            --primary-glow: rgba(56, 189, 248, 0.4);
            --secondary: #818CF8;
            --text-main: #F1F5F9;
            --text-muted: #94A3B8;
            --glass-border: rgba(255, 255, 255, 0.1);
            --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            --whatsapp-green: #25D366;
            --whatsapp-dark: #128C7E;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        html, body { background-color: var(--bg-dark); color: var(--text-main); font-family: 'Outfit', sans-serif; overflow-x: hidden; line-height: 1.7; }
        p, span, small, div, li, td, th { color: inherit !important; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: white !important; }
        a { text-decoration: none; color: inherit; }
        
        /* UTILITIES */
        .text-gradient { background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block; }
        .text-muted { color: var(--text-muted) !important; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid var(--glass-border); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); color: var(--text-main); }
        .reveal { opacity: 0; transform: translateY(50px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* NAVIGATION */
        .navbar { background: rgba(11, 17, 32, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border); padding: 15px 0; transition: all 0.3s ease; }
        .navbar-toggler { border: none; padding: 0; }
        .navbar-toggler .bi-list {color: white !important; font-size: 28px;}
        .navbar-brand { font-weight: 800; font-size: 28px; letter-spacing: -1px; color: white !important; cursor: pointer; }
        .nav-link { color: var(--text-muted) !important; font-weight: 500; margin: 0 10px; position: relative; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        
        /* AUTH BUTTON IN NAV */
        .btn-auth-nav {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--glass-border);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            transition: 0.3s;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }
        .btn-auth-nav:hover { background: var(--primary); color: #000; border-color: var(--primary); }
        .user-avatar-small { width: 24px; height: 24px; border-radius: 50%; object-fit: cover; }

        /* DROPDOWN STYLES */
        .dropdown-menu { background: rgba(30, 41, 59, 0.95) !important; backdrop-filter: blur(10px); border: 1px solid var(--glass-border) !important; }
        .dropdown-item { color: #cbd5e1 !important; }
        .dropdown-item:hover { background: rgba(255,255,255,0.05); color: var(--primary) !important; }

        /* HERO SECTION */
        .hero-section { min-height: 100vh; position: relative; display: flex; align-items: center; padding-top: 80px; overflow: hidden; }
        #heroCanvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; }
        .hero-content { position: relative; z-index: 2; }
        .hero-badge { background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); color: var(--primary); padding: 8px 16px; border-radius: 50px; font-size: 14px; font-weight: 600; display: inline-block; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .hero-title { font-size: 4rem; line-height: 1.1; margin-bottom: 25px; letter-spacing: -2px; color: white !important; }
        .hero-subtitle { font-size: 1.25rem; color: var(--text-muted); margin-bottom: 40px; max-width: 550px; }
        .btn-glow { background: var(--gradient-main); color: white; padding: 14px 35px; border-radius: 50px; font-weight: 600; border: none; position: relative; z-index: 1; overflow: hidden; transition: 0.3s; box-shadow: 0 0 20px rgba(56, 189, 248, 0.3); display: inline-block; }
        .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(56, 189, 248, 0.5); color: white; }
        .btn-outline-glow { background: transparent; color: white; padding: 14px 35px; border-radius: 50px; font-weight: 600; border: 2px solid var(--glass-border); margin-left: 15px; transition: 0.3s; display: inline-block; }
        .btn-outline-glow:hover { border-color: var(--primary); color: var(--primary); }

        /* PROCESS SECTION */
        .section-padding { padding: 100px 0; }
        
        .process-card {
            text-align: center;
            transition: var(--transition);
            height: 100%;
        }
        .process-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 10px 40px rgba(56, 189, 248, 0.15);
        }
        .process-icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(56, 189, 248, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 25px;
            transition: 0.3s;
        }
        .process-card:hover .process-icon-wrapper {
            background: var(--gradient-main);
            color: white;
            transform: rotateY(180deg);
        }
        .step-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: var(--gradient-main);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.1;
            position: absolute;
            top: 10px;
            right: 20px;
            z-index: 0;
            line-height: 1;
        }
        
        /* WHO IS THIS FOR SECTION */
        .audience-card {
            padding: 40px 20px;
            text-align: center;
            transition: var(--transition);
            height: 100%;
            position: relative;
        }
        .audience-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            background: rgba(30, 41, 59, 0.9);
        }
        .audience-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
            display: inline-block;
            padding: 15px;
            border-radius: 50%;
            background: rgba(56, 189, 248, 0.1);
            transition: 0.3s;
        }
        .audience-card:hover .audience-icon {
            background: var(--gradient-main);
            color: white;
            transform: scale(1.1) rotate(10deg);
        }
        .audience-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        /* PROJECTS */
        .project-card { border-radius: 20px; overflow: hidden; position: relative; border: 1px solid var(--glass-border); height: 100%; }
        .project-thumb { height: 220px; overflow: hidden; position: relative; }
        .project-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .project-card:hover .project-thumb img { transform: scale(1.1); }
        .project-overlay { position: absolute; inset: 0; background: rgba(11, 17, 32, 0.8); display: flex; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
        .project-card:hover .project-overlay { opacity: 1; }
        .project-info { padding: 20px; background: var(--bg-card); }

        /* STATS & CTA */
        .stat-big { font-size: 3.5rem; font-weight: 800; line-height: 1; margin-bottom: 10px; }
        .cta-box { background: linear-gradient(135deg, rgba(56, 189, 248, 0.1) 0%, rgba(129, 140, 248, 0.1) 100%); border: 1px solid var(--glass-border); padding: 60px; border-radius: 30px; text-align: center; position: relative; overflow: hidden; }
        .cta-box::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%); animation: rotate 10s linear infinite; }
        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        footer { background: #020617; padding: 50px 0; border-top: 1px solid var(--glass-border); }
        @media (max-width: 768px) { .hero-title { font-size: 2.5rem; } .btn-outline-glow { margin-left: 0; margin-top: 15px; display: block; text-align: center; } }

        /* LOGIN MODAL STYLES */
        .auth-modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .auth-modal-overlay.active {
            display: flex;
            opacity: 1;
        }
        .auth-modal-content {
            background: #1e293b;
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            position: relative;
        }
        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            color: var(--text-muted);
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
        .close-modal:hover { color: white; }
        
        .modal-input {
            width: 100%;
            padding: 12px 15px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            color: white;
            margin-bottom: 15px;
            outline: none;
        }
        .modal-input:focus { border-color: var(--primary); }
        
        .google-btn-modal {
            width: 100%;
            background: white;
            color: #0f172a;
            padding: 12px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: 0.2s;
        }
        .google-btn-modal:hover { background: #e2e8f0; }
        
        .submit-btn-modal {
            width: 100%;
            background: var(--gradient-main);
            color: white;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }
        .divider-modal {
            margin: 20px 0;
            color: var(--text-muted);
            font-size: 0.9rem;
            position: relative;
        }
        .divider-modal::before, .divider-modal::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #334155;
        }
        .divider-modal::before { left: 0; }
        .divider-modal::after { right: 0; }

        /* ==========================================
           WHATSAPP FLOATING BUTTON STYLES
           ========================================== */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: var(--whatsapp-green);
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            animation: pulse-green 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: var(--whatsapp-dark);
            transform: scale(1.1) rotate(10deg);
            color: white;
        }

        /* Tooltip on Hover */
        .whatsapp-float::after {
            content: "Chat with me!";
            position: absolute;
            right: 70px;
            background: white;
            color: #1e293b;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
            white-space: nowrap;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            pointer-events: none;
        }

        .whatsapp-float:hover::after {
            opacity: 1;
            visibility: visible;
            right: 75px;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 26px;
            }
            .whatsapp-float:hover::after {
                display: none; /* Hide tooltip on mobile to save space */
            }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php">Dev<span class="text-gradient">Flow</span>.</a>
        
        <!-- RIGHT SIDE: Toggler + Login/User -->
        <div class="d-flex align-items-center ms-auto">
            
            <!-- Hamburger Menu (Visible on Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="bi bi-list" style="color:white; font-size: 28px;"></span>
            </button>

            <!-- LOGIN BUTTON (Visible when logged out - OUTSIDE COLLAPSE) -->
            <div id="login-btn-container" class="ms-2">
                <button id="nav-auth-btn" class="btn-auth-nav">
                    <i class="bi bi-person"></i> Login
                </button>
            </div>

            <!-- USER DROPDOWN (Visible when logged in - OUTSIDE COLLAPSE) -->
            <div class="dropdown ms-2" id="user-dropdown-container" style="display: none;">
                <a class="btn-auth-nav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img id="dropdown-avatar" src="" class="user-avatar-small">
                    <span id="dropdown-name" class="d-none d-lg-inline">User</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 glass-panel mt-3 shadow-lg">
                    <li>
                        <div class="px-3 py-2">
                            <small class="text-muted d-block">Logged in as</small>
                            <span id="dropdown-email" class="fw-bold text-white">user@email.com</span>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 text-white" href="dashboard.php">
                            <i class="bi bi-grid"></i> Dashboard
                        </a>
                    </li>
                    <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="#" id="nav-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- COLLAPSIBLE MENU CONTENT (Links Only) -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="case-studies.php">Case Studies</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- LOGIN MODAL -->
<div id="auth-modal" class="auth-modal-overlay">
    <div class="auth-modal-content">
        <button class="close-modal" id="close-modal-btn">&times;</button>
        
        <div id="modal-login-view">
            <h2 class="mb-1">Welcome Back</h2>
            <p class="text-muted mb-4">Sign in to DevFlow</p>
            
            <button id="modal-google-btn" class="google-btn-modal">
                <svg width="18" height="18" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Sign in with Google
            </button>
            
            <div class="divider-modal">or</div>
            
            <form id="modal-email-form">
                <input type="email" id="modal-email" class="modal-input" placeholder="Email Address" required>
                <input type="password" id="modal-password" class="modal-input" placeholder="Password" required>
                <div id="modal-error-msg" class="text-danger small mb-3 text-start" style="color: #ef4444; min-height: 20px;"></div>
                <button type="submit" class="submit-btn-modal">Sign In</button>
            </form>
        </div>
    </div>
</div>

<!-- HERO SECTION -->
<section id="hero" class="hero-section">
    <canvas id="heroCanvas"></canvas>
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="hero-badge reveal">Full Stack Developer</span>
                <h1 class="hero-title reveal">Building Digital <br> <span class="text-gradient">Experiences</span> That Matter.</h1>
                <p class="hero-subtitle reveal">
                    <strong>DevFlow</strong>. helps startups and small businesses launch web applications 3x faster through modern development, automation, and AI-powered workflows.
                </p>
                <div class="reveal mt-4">
                    <a href="contact.php" class="btn-glow">Start a Project</a>
                    <a href="portfolio.php" class="btn-outline-glow">View Work</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW I WORK -->
<section class="section-padding">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>How We <span class="text-gradient">Work</span></h2>
            <p>A streamlined process from idea to deployment.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-panel p-5 position-relative process-card reveal">
                    <span class="step-number">01</span>
                    <div class="process-icon-wrapper">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h4>Discovery</h4>
                    <p class="text-muted mt-3">Understanding your goals and planning the technical architecture to ensure success.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel p-5 position-relative process-card reveal" style="transition-delay: 0.1s;">
                    <span class="step-number">02</span>
                    <div class="process-icon-wrapper">
                        <i class="bi bi-code-slash"></i>
                    </div>
                    <h4>Development</h4>
                    <p class="text-muted mt-3">Building high-performance code with modern frameworks and clean standards.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel p-5 position-relative process-card reveal" style="transition-delay: 0.2s;">
                    <span class="step-number">03</span>
                    <div class="process-icon-wrapper">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h4>Launch</h4>
                    <p class="text-muted mt-3">Rigorous testing, deployment, and post-launch support to keep your site running.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHO IS THIS FOR -->
<section class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>Who is this <span class="text-gradient">for?</span></h2>
            <p>I build solutions designed for specific business needs.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 reveal">
                <div class="glass-panel audience-card">
                    <div class="audience-icon">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h4 class="audience-title">Startups</h4>
                    <p class="text-muted small">MVPs & Product Launches</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal" style="transition-delay: 0.1s;">
                <div class="glass-panel audience-card">
                    <div class="audience-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h4 class="audience-title">Institutes</h4>
                    <p class="text-muted small">Educational Platforms</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal" style="transition-delay: 0.2s;">
                <div class="glass-panel audience-card">
                    <div class="audience-icon">
                        <i class="bi bi-shop-window"></i>
                    </div>
                    <h4 class="audience-title">Local Businesses</h4>
                    <p class="text-muted small">Digital Transformation</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal" style="transition-delay: 0.3s;">
                <div class="glass-panel audience-card">
                    <div class="audience-icon">
                        <i class="bi bi-layers-fill"></i>
                    </div>
                    <h4 class="audience-title">SaaS Founders</h4>
                    <p class="text-muted small">Scalable Web Apps</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED WORK -->
<section class="section-padding">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>Selected <span class="text-gradient">Works</span></h2>
            <p>A glimpse into my recent full-stack projects.</p>
        </div>
        <div class="row g-4">
            <?php if(count($featuredProjects) > 0): ?>
                <?php foreach($featuredProjects as $proj): ?>
                    <div class="col-md-6 col-lg-4 reveal">
                        <div class="glass-panel project-card">
                            <div class="project-thumb">
                                <img src="<?= htmlspecialchars($proj['image_url'] ?? 'https://picsum.photos/seed/tech/400/300') ?>" alt="<?= htmlspecialchars($proj['title']) ?>">
                                <div class="project-overlay">
                                    <a href="<?= htmlspecialchars($proj['link'] ?? '#') ?>" target="_blank" class="btn-glow btn-sm">View Live</a>
                                </div>
                            </div>
                            <div class="project-info">
                                <h5><?= htmlspecialchars($proj['title']) ?></h5>
                                <p class="text-muted small text-truncate"><?= htmlspecialchars($proj['description']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5 reveal">
            <a href="portfolio.php" class="btn-outline-glow">View All Projects</a>
        </div>
    </div>
</section>

<!-- QUICK STATS -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 text-center reveal">
                <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-center">
                    <div class="stat-big text-gradient">1+</div>
                    <p class="text-muted fw-bold">Year Experience</p>
                </div>
            </div>
            <div class="col-md-4 text-center reveal">
                <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-center">
                    <div class="stat-big text-gradient">5+</div>
                    <p class="text-muted fw-bold">Projects Completed</p>
                </div>
            </div>
            <div class="col-md-4 text-center reveal">
                <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-center">
                    <div class="stat-big text-gradient">100%</div>
                    <p class="text-muted fw-bold">Client Satisfaction</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="section-padding">
    <div class="container">
        <div class="cta-box reveal">
            <h2 class="mb-3">Ready to build something amazing?</h2>
            <p class="text-muted mb-4">Let's discuss your project and turn your idea into reality.</p>
            <a href="contact.php" class="btn-glow">Get a Quote</a>
        </div>
    </div>
</section>

<footer>
    <div class="container text-center">
        <p class="text-muted mb-0">&copy; 2026 DevFlow. All Rights Reserved.</p>
    </div>
</footer>

<!-- FLOATING WHATSAPP BUTTON -->
<!-- Replace 1234567890 with your actual WhatsApp number -->
<a href="https://wa.me/7057988551" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
    <i class="bi bi-whatsapp"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // CANVAS ANIMATION
    const canvas = document.getElementById('heroCanvas');
    const ctx = canvas.getContext('2d');
    let width, height, particles = [];
    const particleCount = 60, connectionDistance = 150, mouseDistance = 200;
    const mouse = { x: null, y: null };
    function resize() { width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight; }
    window.addEventListener('resize', resize); resize();
    window.addEventListener('mousemove', (e) => { mouse.x = e.x; mouse.y = e.y; });
    window.addEventListener('mouseout', () => { mouse.x = null; mouse.y = null; });
    class Particle {
        constructor() {
            this.x = Math.random() * width; this.y = Math.random() * height;
            this.vx = (Math.random() - 0.5) * 1.5; this.vy = (Math.random() - 0.5) * 1.5;
            this.size = Math.random() * 2 + 1; this.color = '#38BDF8';
        }
        update() {
            this.x += this.vx; this.y += this.vy;
            if (this.x < 0 || this.x > width) this.vx *= -1;
            if (this.y < 0 || this.y > height) this.vy *= -1;
            if (mouse.x != null) {
                let dx = mouse.x - this.x, dy = mouse.y - this.y, distance = Math.sqrt(dx*dx + dy*dy);
                if (distance < mouseDistance) {
                    const forceDirectionX = dx / distance, forceDirectionY = dy / distance;
                    const force = (mouseDistance - distance) / mouseDistance;
                    const directionX = forceDirectionX * force * 2, directionY = forceDirectionY * force * 2;
                    this.vx -= directionX * 0.05; this.vy -= directionY * 0.05;
                }
            }
        }
        draw() { ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2); ctx.fillStyle = this.color; ctx.fill(); }
    }
    function initParticles() { particles = []; for (let i = 0; i < particleCount; i++) particles.push(new Particle()); }
    function animateParticles() {
        ctx.clearRect(0, 0, width, height);
        for (let i = 0; i < particles.length; i++) {
            particles[i].update(); particles[i].draw();
            for (let j = i; j < particles.length; j++) {
                let dx = particles[i].x - particles[j].x, dy = particles[i].y - particles[j].y, distance = Math.sqrt(dx*dx + dy*dy);
                if (distance < connectionDistance) {
                    ctx.beginPath();
                    let opacity = 1 - (distance / connectionDistance);
                    ctx.strokeStyle = `rgba(56, 189, 248, ${opacity * 0.5})`;
                    ctx.lineWidth = 1;
                    ctx.moveTo(particles[i].x, particles[i].y); ctx.lineTo(particles[j].x, particles[j].y); ctx.stroke();
                }
            }
        }
        requestAnimationFrame(animateParticles);
    }
    initParticles(); animateParticles();

    // SCROLL REVEAL
    const observerOptions = { threshold: 0.15 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { entry.target.classList.add('active'); observer.unobserve(entry.target); }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // ==========================================
    // SECRET ACCESS FUNCTIONS
    // ==========================================

    // Function 1: Handle the Redirect
    function handleRedirect(url) {
        window.location.href = url;
    }

    // Function 2: Setup Secret Access (Keyboard & Mouse)
    function initSecretAccess() {
        
        // --- LOGIC 1: KEYBOARD SHORTCUT ---
        window.addEventListener('keydown', function(e) {
            // Ctrl + Shift + A -> Admin
            if (e.ctrlKey && e.shiftKey && (e.key === 'A' || e.key === 'a')) {
                e.preventDefault();
                handleRedirect('admin.php');
            }
            
            // Ctrl + Shift + D -> Dashboard
            if (e.ctrlKey && e.shiftKey && (e.key === 'D' || e.key === 'd')) {
                e.preventDefault();
                handleRedirect('dashboard.php');
            }
        });

        // --- LOGIC 2: DOUBLE CLICK LOGO ---
        const brandLogo = document.querySelector('.navbar-brand');
        if (brandLogo) {
            brandLogo.addEventListener('dblclick', function(e) {
                e.preventDefault();
                handleRedirect('admin.php');
            });
        }
    }

    // Initialize Secret Access
    initSecretAccess();
</script>

<!-- FIREBASE AUTHENTICATION MODULE -->
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import { 
        getAuth, 
        GoogleAuthProvider, 
        signInWithPopup, 
        signOut, 
        onAuthStateChanged,
        signInWithEmailAndPassword 
    } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

    // =======================================================
    // PASTE YOUR FIREBASE CONFIG HERE
    // =======================================================
   const firebaseConfig = {
  apiKey: "AIzaSyBs_IJ_74Y8GsyChljUe2574PvyKokhV9c",
  authDomain: "login-f9a06.firebaseapp.com",
  projectId: "login-f9a06",
  storageBucket: "login-f9a06.firebasestorage.app",
  messagingSenderId: "493587142230",
  appId: "1:493587142230:web:d87480038d5f020d71cdf7",
  measurementId: "G-451PH7KT8T"
};
    // =======================================================

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const provider = new GoogleAuthProvider();

    // DOM Elements
    const navAuthBtn = document.getElementById('nav-auth-btn');
    const authModal = document.getElementById('auth-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const googleBtn = document.getElementById('modal-google-btn');
    const emailForm = document.getElementById('modal-email-form');
    const errorMsg = document.getElementById('modal-error-msg');
    
    // Dropdown Elements
    const userDropdown = document.getElementById('user-dropdown-container');
    const loginBtnContainer = document.getElementById('login-btn-container');
    const logoutBtn = document.getElementById('nav-logout-btn');
    const dropdownAvatar = document.getElementById('dropdown-avatar');
    const dropdownName = document.getElementById('dropdown-name');
    const dropdownEmail = document.getElementById('dropdown-email');

    // 1. Open Modal (Only if logged out)
    navAuthBtn.addEventListener('click', () => {
        authModal.classList.add('active');
    });

    // 2. Close Modal
    closeModalBtn.addEventListener('click', () => {
        authModal.classList.remove('active');
        errorMsg.textContent = "";
    });
    authModal.addEventListener('click', (e) => {
        if (e.target === authModal) authModal.classList.remove('active');
    });

    // 3. Google Login
    googleBtn.addEventListener('click', () => {
        signInWithPopup(auth, provider)
            .then(() => authModal.classList.remove('active'))
            .catch((error) => errorMsg.textContent = "Google Login Failed: " + error.message);
    });

    // 4. Email Login
    emailForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('modal-email').value;
        const password = document.getElementById('modal-password').value;
        signInWithEmailAndPassword(auth, email, password)
            .then(() => authModal.classList.remove('active'))
            .catch((error) => errorMsg.textContent = "Login Failed: " + error.message);
    });

    // 5. Auth State Listener (Updated for Dropdown)
    onAuthStateChanged(auth, (user) => {
        if (user) {
            // User is signed in
            loginBtnContainer.style.display = 'none';
            userDropdown.style.display = 'block';

            // Update Dropdown Data
            const photoUrl = user.photoURL || `https://ui-avatars.com/api/?name=${user.email}&background=random`;
            const displayName = user.displayName || user.email.split('@')[0];

            dropdownAvatar.src = photoUrl;
            dropdownName.textContent = displayName;
            dropdownEmail.textContent = user.email;
        } else {
            // User is signed out
            loginBtnContainer.style.display = 'block';
            userDropdown.style.display = 'none';
        }
    });

    // 6. Logout Handler
    if(logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            signOut(auth).then(() => {
                console.log("Logged out");
            });
        });
    }
</script>
</body>
</html>