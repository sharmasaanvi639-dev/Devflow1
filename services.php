<?php $currentPage = 'services.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | Dev Flow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --bg-dark: #0B1120; --bg-card: rgba(30, 41, 59, 0.7); --primary: #38BDF8; --text-muted: #94A3B8; --glass-border: rgba(255, 255, 255, 0.1); --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%); }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        html, body { background-color: var(--bg-dark); color: #F1F5F9; font-family: 'Outfit', sans-serif; overflow-x: hidden; line-height: 1.7; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: white !important; }
        a { text-decoration: none; color: inherit; }
        .text-gradient { background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block; }
        .text-muted { color: var(--text-muted) !important; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid var(--glass-border); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); color: #F1F5F9; }
        .reveal { opacity: 0; transform: translateY(50px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .navbar { background: rgba(11, 17, 32, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border); padding: 15px 0; }
        .navbar-toggler { border: none; padding: 0; }
        .navbar-toggler .bi-list {color: white !important; font-size: 28px;}
        .navbar-brand { font-weight: 800; font-size: 28px; color: white !important; cursor: pointer; }
        .nav-link { color: var(--text-muted) !important; font-weight: 500; margin: 0 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        .section-padding { padding: 100px 0; }
        .hero-section { min-height: 60vh; position: relative; display: flex; align-items: center; padding-top: 80px; background: rgba(0,0,0,0.2); }
        .service-card { padding: 50px 40px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); height: 100%; position: relative; overflow: hidden; text-align: center; }
        .service-card:hover { transform: translateY(-10px); border-color: rgba(56, 189, 248, 0.3); background: rgba(30, 41, 59, 0.9); }
        .service-icon { width: 80px; height: 80px; background: rgba(56, 189, 248, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 36px; color: var(--primary); margin: 0 auto 25px; transition: 0.3s; }
        .service-card:hover .service-icon { background: var(--gradient-main); color: white; transform: rotateY(180deg); }
        .pricing-list { list-style: none; padding: 0; margin: 0; text-align: left; }
        .pricing-list li { margin-bottom: 15px; padding-left: 25px; position: relative; color: var(--text-muted); }
        .pricing-list li::before { content: '✔'; position: absolute; left: 0; color: var(--primary); font-weight: bold; }
        footer { background: #020617; padding: 50px 0; border-top: 1px solid var(--glass-border); margin-top: 50px; }

        /* LOGIN & DROPDOWN STYLES */
        .btn-auth-nav { background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: white; padding: 6px 16px; border-radius: 50px; transition: 0.3s; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; white-space: nowrap; }
        .btn-auth-nav:hover { background: var(--primary); color: #000; border-color: var(--primary); }
        .user-avatar-small { width: 24px; height: 24px; border-radius: 50%; object-fit: cover; }
        .dropdown-menu { background: rgba(30, 41, 59, 0.95) !important; backdrop-filter: blur(10px); border: 1px solid var(--glass-border) !important; }
        .dropdown-item { color: #cbd5e1 !important; }
        .dropdown-item:hover { background: rgba(255,255,255,0.05); color: var(--primary) !important; }
        
        .auth-modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); backdrop-filter: blur(5px); z-index: 9999; display: none; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; }
        .auth-modal-overlay.active { display: flex; opacity: 1; }
        .auth-modal-content { background: #1e293b; border: 1px solid var(--glass-border); border-radius: 20px; padding: 40px; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.5); position: relative; }
        .close-modal { position: absolute; top: 15px; right: 15px; color: var(--text-muted); background: none; border: none; font-size: 24px; cursor: pointer; }
        .modal-input { width: 100%; padding: 12px 15px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: white; margin-bottom: 15px; outline: none; }
        .modal-input:focus { border-color: var(--primary); }
        .google-btn-modal { width: 100%; background: white; color: #0f172a; padding: 12px; border-radius: 50px; border: none; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; margin-bottom: 20px; }
        .submit-btn-modal { width: 100%; background: var(--gradient-main); color: white; padding: 12px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; }
        .divider-modal { margin: 20px 0; color: var(--text-muted); font-size: 0.9rem; position: relative; }
        .divider-modal::before, .divider-modal::after { content: ''; position: absolute; top: 50%; width: 40%; height: 1px; background: #334155; }
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
            background-color: #25D366;
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
            background-color: #128C7E;
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
                display: none; /* Hide tooltip on mobile */
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
                <a class="dropdown-toggle btn-auth-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img id="dropdown-avatar" src="" class="user-avatar-small">
                    <span id="dropdown-name" class="d-none d-lg-inline">User</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 glass-panel mt-3 shadow-lg">
                    <li><div class="px-3 py-2"><small class="text-muted d-block">Logged in as</small><span id="dropdown-email" class="fw-bold text-white">user@email.com</span></div></li>
                    <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2 text-white" href="dashboard.php"><i class="bi bi-grid"></i> Dashboard</a></li>
                    <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="#" id="nav-logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            </div>

        </div>

        <!-- COLLAPSIBLE MENU CONTENT (Links Only) -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="services.php">Services</a></li>
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
        <h2 class="mb-1">Welcome Back</h2>
        <p class="text-muted mb-4">Sign in to DevFlow</p>
        <button id="modal-google-btn" class="google-btn-modal">
            <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Sign in with Google
        </button>
        <div class="divider-modal">or</div>
        <form id="modal-email-form"><input type="email" id="modal-email" class="modal-input" placeholder="Email Address" required><input type="password" id="modal-password" class="modal-input" placeholder="Password" required><div id="modal-error-msg" class="text-danger small mb-3 text-start" style="color: #ef4444; min-height: 20px;"></div><button type="submit" class="submit-btn-modal">Sign In</button></form>
    </div>
</div>

<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3 reveal">My <span class="text-gradient">Services</span></h1>
        <p class="lead text-muted reveal">Comprehensive web solutions tailored to your business needs.</p>
    </div>
</section>

<section id="services" class="section-padding">
    <div class="container">
        <div class="section-header reveal">
            <h2>Core <span class="text-gradient">Expertise</span></h2>
            <p>Tailored tech solutions for modern businesses.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-panel service-card reveal">
                    <div class="service-icon"><i class="bi bi-code-slash"></i></div>
                    <h4>Web Development</h4>
                    <p class="text-muted mt-3">Custom web applications built with HTML5, CSS3, JavaScript, and PHP. High performance and SEO optimized.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel service-card reveal" style="transition-delay: 0.1s;">
                    <div class="service-icon"><i class="bi bi-phone"></i></div>
                    <h4>Responsive Design</h4>
                    <p class="text-muted mt-3">Fluid layouts that adapt perfectly to mobile, tablet, and desktop screens using modern CSS frameworks.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-panel service-card reveal" style="transition-delay: 0.2s;">
                    <div class="service-icon"><i class="bi bi-cart-check"></i></div>
                    <h4>Business Solutions</h4>
                    <p class="text-muted mt-3">Complex systems including trading portals, educational platforms, and payment gateway integrations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="pricing" class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container">
        <div class="section-header text-center reveal">
            <h2>Website <span class="text-gradient">Pricing</span></h2>
            <p>Affordable and professional web development services.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <!-- Card 1: Landing Page -->
            <div class="col-lg-4 col-md-6 reveal">
                <div class="glass-panel service-card text-center">
                    <div class="service-icon mx-auto">
                        <i class="bi bi-window-sidebar"></i>
                    </div>
                    <h3>Landing Page</h3>
                    <div class="my-4">
                        <h1 class="text-gradient fw-bold">₹3,000+</h1>
                    </div>
                    <ul class="list-unstyled pricing-list">
                        <li>Single Page Layout</li>
                        <li>Fast Loading Speed</li>
                        <li>Mobile Responsive</li>
                        <li>Basic Animations</li>
                    </ul>
                </div>
            </div>

            <!-- Card 2: Business Website -->
            <div class="col-lg-4 col-md-6 reveal" style="transition-delay: 0.1s;">
                <div class="glass-panel service-card text-center" style="border: 1px solid var(--primary);">
                    <div class="service-icon mx-auto" style="background: var(--gradient-main); color: white;">
                        <i class="bi bi-shop"></i>
                    </div>
                    <h3>Business Website</h3>
                    <div class="my-4">
                        <h1 class="text-gradient fw-bold">₹6,000+</h1>
                    </div>
                    <ul class="list-unstyled pricing-list">
                        <li>5-7 Pages</li>
                        <li>Contact Forms</li>
                        <li>SEO Optimized</li>
                        <li>Admin Panel</li>
                    </ul>
                </div>
            </div>

            <!-- Card 3: Custom Web App -->
            <div class="col-lg-4 col-md-6 reveal" style="transition-delay: 0.2s;">
                <div class="glass-panel service-card text-center">
                    <div class="service-icon mx-auto">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h3>Custom Web App</h3>
                    <div class="my-4">
                        <h1 class="text-gradient fw-bold">₹9,000+</h1>
                    </div>
                    <ul class="list-unstyled pricing-list">
                        <li>Full Stack Development</li>
                        <li>Database Integration</li>
                        <li>User Authentication</li>
                        <li>API Development</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="glass-panel p-4 reveal text-center">
                    <h4 class="mb-3">Important Note</h4>
                    <p class="text-muted mb-0">
                        Prices shown above are starting prices. Final pricing depends on project requirements,
                        number of pages, custom design, admin panel, payment gateway integration,
                        API integrations, database complexity, deployment requirements,
                        and additional custom features.
                    </p>
                    <p class="mt-3 mb-0 fw-bold text-white">
                        Final cost will be discussed after understanding the project requirements.
                    </p>
                </div>
            </div>
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
    const observerOptions = { threshold: 0.15 };
    const observer = new IntersectionObserver((entries) => { 
        entries.forEach(entry => { 
            if (entry.isIntersecting) { 
                entry.target.classList.add('active'); 
                observer.unobserve(entry.target); 
            } 
        }); 
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

<!-- FIREBASE AUTH -->
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import { getAuth, GoogleAuthProvider, signInWithPopup, signOut, onAuthStateChanged, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBs_IJ_74Y8GsyChljUe2574PvyKokhV9c",
        authDomain: "login-f9a06.firebaseapp.com",
        projectId: "login-f9a06",
        storageBucket: "login-f9a06.firebasestorage.app",
        messagingSenderId: "493587142230",
        appId: "1:493587142230:web:d87480038d5f020d71cdf7",
        measurementId: "G-451PH7KT8T"
    };

    const app = initializeApp(firebaseConfig); 
    const auth = getAuth(app); 
    const provider = new GoogleAuthProvider();

    const navAuthBtn = document.getElementById('nav-auth-btn'); 
    const authModal = document.getElementById('auth-modal'); 
    const closeModalBtn = document.getElementById('close-modal-btn'); 
    const googleBtn = document.getElementById('modal-google-btn'); 
    const emailForm = document.getElementById('modal-email-form'); 
    const errorMsg = document.getElementById('modal-error-msg');
    
    const userDropdown = document.getElementById('user-dropdown-container'); 
    const loginBtnContainer = document.getElementById('login-btn-container'); 
    const logoutBtn = document.getElementById('nav-logout-btn'); 
    const dropdownAvatar = document.getElementById('dropdown-avatar'); 
    const dropdownName = document.getElementById('dropdown-name'); 
    const dropdownEmail = document.getElementById('dropdown-email');

    navAuthBtn.addEventListener('click', () => authModal.classList.add('active'));
    
    closeModalBtn.addEventListener('click', () => { 
        authModal.classList.remove('active'); 
        errorMsg.textContent = ""; 
    });
    
    authModal.addEventListener('click', (e) => { 
        if (e.target === authModal) authModal.classList.remove('active'); 
    });
    
    googleBtn.addEventListener('click', () => { 
        signInWithPopup(auth, provider)
            .then(() => authModal.classList.remove('active'))
            .catch((e) => errorMsg.textContent = e.message); 
    });

    emailForm.addEventListener('submit', (e) => { 
        e.preventDefault(); 
        const email = document.getElementById('modal-email').value; 
        const pass = document.getElementById('modal-password').value; 
        signInWithEmailAndPassword(auth, email, pass)
            .then(() => authModal.classList.remove('active'))
            .catch((e) => errorMsg.textContent = e.message); 
    });

    onAuthStateChanged(auth, (user) => {
        if (user) { 
            loginBtnContainer.style.display = 'none'; 
            userDropdown.style.display = 'block'; 
            const pUrl = user.photoURL || `https://ui-avatars.com/api/?name=${user.email}&background=random`; 
            const dName = user.displayName || user.email.split('@')[0]; 
            dropdownAvatar.src = pUrl; 
            dropdownName.textContent = dName; 
            dropdownEmail.textContent = user.email; 
        } else { 
            loginBtnContainer.style.display = 'block'; 
            userDropdown.style.display = 'none'; 
        }
    });

    if(logoutBtn) { 
        logoutBtn.addEventListener('click', (e) => { 
            e.preventDefault(); 
            signOut(auth); 
        }); 
    }
</script>
</body>
</html>
