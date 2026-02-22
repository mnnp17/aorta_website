<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/Logo%20AORTA%20(2).png') }}">
    <title>@yield('title', 'AORTA Malang')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@400;500;600&display=swap">
    <!-- Hubungkan ke CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    @stack('styles')
</head>
<body>
    <header>
        <div class="header-content">
            <nav class="navbar" id="navbar">
                <div class="nav-logo">
                    <!-- Logo AORTA -->
                    <img src="{{ asset('img/Logo%20AORTA%20(2).png') }}" alt="AORTA Malang Logo" class="logo-img">
                </div>
                
                <!-- Menu Toggle untuk Mobile -->
                <button class="menu-toggle" id="menuToggle">☰</button>
                
                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/articles') }}" class="nav-link {{ request()->is('articles') ? 'active' : '' }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/projects') }}" class="nav-link {{ request()->is('projects') ? 'active' : '' }}">Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/tentang-kami') }}" class="nav-link {{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a>
                    </li>
                </ul>
            </nav>
            
            @hasSection('hero')
                @yield('hero')
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-content footer-top-border">
            <!-- Sisi Kiri: Copyright -->
            <div class="copyright">2025 - AORTA MALANG</div>
            
            <!-- Sisi Kanan: Social Media -->
            <div class="social-media">
                <a href="https://www.tiktok.com/@aorta.malang?_t=ZS-90fsbBahod6&_r=1" class="social-icon" title="TikTok" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="https://www.instagram.com/aortacommunitymalang?igsh=MW9yZDA5M253ZXZzZw%3D%3D&utm_source=qr" class="social-icon" title="Instagram" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-instagram"></i>
                </a>
               <a href="https://mail.google.com/mail/?view=cm&fs=1&to=aortamalang@gmail.com" class="social-icon" title="Gmail" target="_blank" rel="noopener noreferrer">
                    <i class="far fa-envelope"></i>
                </a>
                <a href="https://youtube.com/@aortamalang?si=CszVRgovv8Uhun79" class="social-icon" title="YouTube" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </footer>
    
    <script>
        // JavaScript untuk sticky navigation
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');
            const header = document.querySelector('header');
            
            if (header && navbar) {
                const headerHeight = header.offsetHeight;
                
                // Function to handle scroll
                function handleScroll() {
                    if (window.scrollY > headerHeight - 100) {
                        navbar.classList.add('sticky');
                    } else {
                        navbar.classList.remove('sticky');
                    }
                }
                
                // Listen for scroll events
                window.addEventListener('scroll', handleScroll);
            }
            
            // Smooth scroll untuk tombol Pelajari Lebih Lanjut
            const learnMoreBtn = document.querySelector('.learn-more-btn');
            if (learnMoreBtn) {
                learnMoreBtn.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href.startsWith('#')) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            window.scrollTo({
                                top: target.offsetTop - 80, // Adjust for sticky nav
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            }
            
            // Mobile menu toggle
            const menuToggle = document.getElementById('menuToggle');
            const navMenu = document.getElementById('navMenu');
            
            if (menuToggle && navMenu) {
                menuToggle.addEventListener('click', function() {
                    navMenu.classList.toggle('active');
                });
            }
            
            // App-specific logic from original file
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Terapkan animasi pada section
            const sections = document.querySelectorAll('section');
            sections.forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(section);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
