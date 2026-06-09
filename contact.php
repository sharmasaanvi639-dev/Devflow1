<?php
 $supabaseUrl = "https://gflakfgduibcppsaowao.supabase.co"; 
 $supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImdmbGFrZmdkdWliY3Bwc2Fvd2FvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NjI4OTYsImV4cCI6MjA5NjEzODg5Nn0.XvJ8hJgCkVDaQKeRkxM9meFhBD1a7gvyeqF29BYnAI0"; 

function supabase_post($url, $key, $table, $data) {
    $endpoint = $url . "/rest/v1/" . $table;
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $key, 
        "Authorization: Bearer " . $key, 
        "Content-Type: application/json", 
        "Prefer: return=minimal"
    ]);
    $response = curl_exec($ch); 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close($ch);
    return $httpCode == 201; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $name = trim($_POST['name'] ?? ''); 
    $email = trim($_POST['email'] ?? ''); 
    $phone = trim($_POST['phone'] ?? ''); 
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($phone) || empty($message)) { 
        echo json_encode(["status" => "error", "message" => "All fields are required."]); 
        exit; 
    }
    
    if (supabase_post($supabaseUrl, $supabaseKey, "messages", [
        "name" => $name, 
        "email" => $email, 
        "phone" => $phone, 
        "message" => $message
    ])) { 
        echo json_encode(["status" => "success", "message" => "Message sent successfully!"]); 
    } else { 
        echo json_encode(["status" => "error", "message" => "Failed to save message."]); 
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Nikhil Honkalaskar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root { --bg-dark: #0B1120; --bg-card: rgba(30, 41, 59, 0.7); --primary: #38BDF8; --text-muted: #94A3B8; --glass-border: rgba(255, 255, 255, 0.1); --gradient-main: linear-gradient(135deg, #38BDF8 0%, #818CF8 100%); }
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        html, body { background-color: var(--bg-dark); color: #F1F5F9; font-family: 'Outfit', sans-serif; overflow-x: hidden; line-height: 1.7; }
        p, span, small, div, li { color: inherit !important; }
        h1, h2, h3, h4 { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: white !important; }
        a { text-decoration: none; color: inherit; }
        .text-gradient { background: var(--gradient-main); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block; }
        .text-muted { color: var(--text-muted) !important; }
        .glass-panel { background: var(--bg-card); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid var(--glass-border); border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); color: #F1F5F9; }
        .reveal { opacity: 0; transform: translateY(50px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .navbar { background: rgba(11, 17, 32, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border); padding: 15px 0; }
        .navbar-toggler { border: none; padding: 0; }
        .navbar-toggler .bi-list { color: white !important; font-size: 28px; }
        .navbar-brand { font-weight: 800; font-size: 28px; color: white !important; cursor: pointer; }
        .nav-link { color: var(--text-muted) !important; font-weight: 500; margin: 0 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        .section-padding { padding: 100px 0; }
        .hero-section { min-height: 60vh; position: relative; display: flex; align-items: center; padding-top: 80px; background: rgba(0,0,0,0.2); }
        .form-control { background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); color: #ffffff !important; padding: 15px; border-radius: 10px; }
        .form-control::placeholder { color: rgba(255,255,255,0.5) !important; opacity: 1; }
        .form-control:focus { background: rgba(255,255,255,0.1); border-color: var(--primary); color: white !important; box-shadow: 0 0 15px rgba(56, 189, 248, 0.2); }
        .form-label { color: var(--text-muted) !important; }
        .btn-glow { background: var(--gradient-main); color: white; padding: 14px 35px; border-radius: 50px; font-weight: 600; border: none; transition: 0.3s; box-shadow: 0 0 20px rgba(56, 189, 248, 0.3); }
        .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(56, 189, 248, 0.5); color: white; }
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .custom-toast { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); color: white !important; padding: 15px 25px; border-radius: 10px; border-left: 4px solid var(--primary); box-shadow: 0 10px 30px rgba(0,0,0,0.5); display: flex; align-items: center; gap: 15px; transform: translateX(120%); transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); min-width: 300px; }
        .custom-toast.show { transform: translateX(0); }
        .custom-toast.success { border-left-color: #22c55e; }
        .custom-toast.error { border-left-color: #ef4444; }
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
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
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
        <h1 class="display-4 fw-bold mb-3 reveal">Get In <span class="text-gradient">Touch</span></h1>
        <p class="lead text-muted reveal">Let's build something amazing together.</p>
    </div>
</section>

<section id="contact" class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-panel p-5 reveal">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Your Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Your Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Message</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Tell me about your project..." required></textarea>
                        </div>
                        <button type="submit" class="btn-glow w-100" id="submitBtn">Send Message <i class="bi bi-send-fill ms-2"></i></button>
                    </form>
                </div>
                <div class="text-center mt-4 reveal">
                    <p class="text-muted">Or contact me directly on</p>
                    <a href="https://wa.me/917057988551" class="text-white fs-4 me-4"><i class="bi bi-whatsapp"></i></a>
                    <a href="mailto:contact@nikhildev.com" class="text-white fs-4 me-4"><i class="bi bi-envelope-fill"></i></a>
                    <a href="https://linkedin.com/in/nikhil-honkalaskar-458a09303" class="text-white fs-4"><i class="bi bi-linkedin"></i></a>
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
<a href="https://wa.me/1234567890" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
    <i class="bi bi-whatsapp"></i>
</a>

<div class="toast-container" id="toastContainer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Contact Form Logic
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer'); 
        const toast = document.createElement('div');
        toast.className = `custom-toast ${type}`; 
        let icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
        toast.innerHTML = `<i class="bi ${icon} fs-5"></i><div><h6 class="mb-0 fw-bold">${type === 'success' ? 'Success' : 'Error'}</h6><small class="opacity-75">${message}</small></div>`;
        container.appendChild(toast); 
        setTimeout(() => toast.classList.add('show'), 100);
        setTimeout(() => { 
            toast.classList.remove('show'); 
            setTimeout(() => toast.remove(), 400); 
        }, 3000);
    }

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault(); 
        const btn = document.getElementById('submitBtn'); 
        const originalText = btn.innerHTML; 
        btn.disabled = true; 
        btn.innerHTML = 'Sending...';
        
        fetch(window.location.href, { method: 'POST', body: new FormData(this) })
        .then(response => response.json())
        .then(data => {
            btn.disabled = false; 
            btn.innerHTML = originalText;
            if (data.status === 'success') { 
                showToast(data.message, "success"); 
                this.reset(); 
            } else { 
                showToast(data.message, "error"); 
            }
        }).catch(error => { 
            btn.disabled = false; 
            btn.innerHTML = originalText; 
            showToast("Connection error.", "error"); 
        });
    });

    // Reveal Animation
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