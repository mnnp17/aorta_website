@extends('layouts.app')

@section('title', 'Tentang Kami - AORTA Malang')

@push('styles')
<style>
    /* CSS INTERNAL KHUSUS ABOUT PAGE */
    
    header {
        background-image: linear-gradient(135deg, rgba(21, 64, 105, 0.9) 0%, rgba(26, 154, 169, 0.9) 100%), 
                    url('{{ asset('img/Peka%202.JPG') }}');
    }
    
    .tagline {
        font-size: 2.2rem;
        background: linear-gradient(to right, #ffffff, #e0f7fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-text-container {
        top: 58% !important;
        max-width: 1000px !important;
    }

    /* About Cards Section */
    .about-section {
        padding: 80px 20px;
        background: white;
        margin: 3rem auto 1rem;
        max-width: 1200px;
    }
    
    .about-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .about-card {
        background: white;
        border-radius: 12px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0,0,0,0.03);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .about-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--primary);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }
    
    .about-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .about-card:hover::before {
        transform: scaleX(1);
    }
    
    .card-icon {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 25px;
        transition: transform 0.4s ease;
    }
    
    .about-card:hover .card-icon {
        transform: scale(1.1);
    }
    
    .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Active State for Cards */
    .about-card.active {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border-color: var(--primary);
    }
    
    .about-card.active::before {
        transform: scaleX(1);
    }

    /* Interactive Content Area */
    .about-content-display {
        margin-top: 50px;
        background: #f8fbff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.05);
        display: none; /* Hidden by default */
        animation: fadeIn 0.5s ease-out;
        border-left: 5px solid var(--primary);
    }

    .content-item {
        display: none;
    }

    .content-item.active {
        display: block;
    }

    .content-title {
        color: var(--primary);
        font-size: 2rem;
        margin-bottom: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .content-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #444;
    }

    .visi-text {
        font-style: italic;
        font-weight: 500;
        color: var(--dark);
        position: relative;
        padding-left: 30px;
    }

    .visi-text::before {
        content: '"';
        position: absolute;
        left: 0;
        top: -10px;
        font-size: 3rem;
        color: var(--accent);
        opacity: 0.5;
    }

    .misi-list {
        list-style: none;
        padding-left: 0;
    }

    .misi-list li {
        margin-bottom: 15px;
        display: flex;
        gap: 15px;
        align-items: flex-start;
    }

    .misi-list li i {
        color: var(--primary);
        margin-top: 5px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Tagline Specific Styles */
    .tagline-main {
        font-size: 2.22rem;
        color: var(--primary);
        font-weight: 800;
        text-align: center;
        margin-bottom: 40px;
        letter-spacing: -0.5px;
    }

    .tagline-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 30px;
    }

    .tagline-col {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border-top: 4px solid var(--accent);
        transition: all 0.3s ease;
    }

    .tagline-col:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .tagline-col h5 {
        color: var(--dark);
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .tagline-col p {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 0;
    }

    @media (max-width: 900px) {
        .tagline-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Guide Section Styling Match */
    .guide-section {
        padding: 60px 20px 80px;
        background: white;
        margin: 0rem auto 3rem;
        max-width: 1200px;
    }
    
    .guide-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    
    .guide-step {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        text-align: center;
        position: relative;
    }

    /* Login Section Styles */
    .login-section {
        padding: 80px 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin-top: 50px;
        border-radius: 20px;
    }
    
    .login-container {
        max-width: 500px;
        margin: 0 auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .login-button {
        width: 100%;
        padding: 12px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .login-button:hover {
        background: #1a5a94;
    }
    
    @media (max-width: 992px) {
        .hero-text-container {
            text-align: center;
            margin-left: 0;
            margin-bottom: 40px;
            top: 62% !important;
        }
        .tagline {
            text-align: center;
        }
    }
</style>
@endpush

@section('hero')
    <div class="hero-text-container">
        <div class="tagline">Mari Peduli Sesama Dengan Bergabung Menjadi Keluarga AORTA Malang</div>
        <p class="tagline-sub">Let's Learn, Grow, and Act Together</p>
        <a href="#about" class="learn-more-btn">
            Mengenal Kami <i class="fas fa-arrow-down"></i>
        </a>
    </div>
@endsection

@section('content')
    <!-- About Boxes Section -->
    <section id="about" class="about-section animate-on-scroll">
        <div class="section-header" style="text-align: center; margin-bottom: 50px;">
            <h2 class="section-title" style="font-size: 2.5rem; color: var(--primary);">Tentang Kami</h2>
            <p class="section-subtitle">Mengenal lebih dekat visi, cara kerja, dan tim di balik AORTA Malang</p>
        </div>
        
        <div class="about-cards">
            <!-- Visi & Misi -->
            <div class="about-card" data-target="visi-misi">
                <div class="card-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="card-title">Visi & Misi</h3>
            </div>
            
            <!-- Workflow -->
            <div class="about-card" data-target="workflow">
                <div class="card-icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h3 class="card-title">Workflow</h3>
            </div>
            
            <!-- Struktur Tim -->
            <div class="about-card" data-target="struktur">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="card-title">Struktur Tim</h3>
            </div>
            
            <!-- Tagline -->
            <div class="about-card" data-target="tagline">
                <div class="card-icon">
                    <i class="fas fa-quote-left"></i>
                </div>
                <h3 class="card-title">Tagline</h3>
            </div>
        </div>

        <!-- Content Display Area -->
        <div id="about-content" class="about-content-display">
            <!-- Visi & Misi Content -->
            <div id="visi-misi" class="content-item">
                <div class="content-title">
                    <i class="fas fa-bullseye"></i> Visi & Misi
                </div>
                <div class="content-text">
                    <h4 style="margin-bottom: 10px; color: var(--dark);">Visi</h4>
                    <p class="visi-text">"Menjadi wadah bagi remaja Indonesia dalam pengembangan potensi dan berkontribusi untuk mewujudkan akselerasi peningkatan taraf kesehatan serta mengabdi kepada masyarakat secara menyeluruh."</p>
                    
                    <h4 style="margin-top: 30px; margin-bottom: 15px; color: var(--dark);">Misi</h4>
                    <ul class="misi-list">
                        <li><i class="fas fa-check-circle"></i> <span>Menjadikan AORTA Community sebagai role model yang mampu menginspirasi.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Memaksimalkan peran chapter daerah dalam melakukan aksi kepedulian terhadap kesehatan remaja berdasarkan empat pilar AORTA Community.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Berkolaborasi dengan berbagai pihak dan stakeholder terkait dalam membangun relasi yang mendukung penyelesaian isu-isu kesehatan.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Informatif terhadap seluruh seluruh kegiatan yang dilaksanakan Aorta Community.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Peningkatan kapasitas anggota Aorta Community melalui berbagai media pengembangan.</span></li>
                    </ul>
                </div>
            </div>

            <!-- Workflow Content -->
            <div id="workflow" class="content-item">
                <div class="content-title">
                    <i class="fas fa-project-diagram"></i> Workflow
                </div>
                <div class="content-text" style="text-align: center;">
                    <p style="margin-bottom: 20px;">Berikut adalah gambaran alur kerja dan proses yang kami jalankan di AORTA Malang:</p>
                    <div class="workflow-img-container" style="max-width: 800px; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <img src="{{ asset('img/workflow.jpeg') }}" alt="Workflow AORTA Malang" style="width: 100%; height: auto; display: block;">
                    </div>
                </div>
            </div>

            <!-- Struktur Tim Content -->
            <div id="struktur" class="content-item">
                <div class="content-title">
                    <i class="fas fa-users"></i> Struktur Tim
                </div>
                <div class="content-text" style="text-align: center;">
                    <p style="margin-bottom: 20px;">Berikut adalah struktur organisasi AORTA Malang:</p>
                    <div class="struktur-img-container" style="max-width: 900px; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <img src="{{ asset('img/struktur.jpeg') }}" alt="Struktur Tim AORTA Malang" style="width: 100%; height: auto; display: block;">
                    </div>
                </div>
            </div>

            <!-- Tagline Content -->
            <div id="tagline" class="content-item">
                <div class="content-title">
                    <i class="fas fa-quote-left"></i> Tagline
                </div>
                <div class="content-text">
                    <div class="tagline-main">"Learning, Grow, and Act Together"</div>
                    
                    <div class="tagline-grid">
                        <!-- Col 1 -->
                        <div class="tagline-col">
                            <h5>KITA BELAJAR UNTUK SADAR DAN SIAP</h5>
                            <p>AORTA percaya bahwa perubahan dimulai dari pengetahuan. AORTA membangun ruang belajar yang terbuka, relevan, dan menyenangkan</p>
                        </div>
                        
                        <!-- Col 2 -->
                        <div class="tagline-col">
                            <h5>KITA TUMBUH BERSAMA, BUKAN SENDIRI</h5>
                            <p>Setiap anggota AORTA adalah tunas yang sedang tumbuh. AORTA mendorong pengembangan diri dan menciptakan ekosistem yang mendukung pertumbuhan kolektif.</p>
                        </div>
                        
                        <!-- Col 3 -->
                        <div class="tagline-col">
                            <h5>BELAJAR DAN BERTUMBUH TANPA TINDAKAN ADALAH SIA-SIA.</h5>
                            <p>AORTA hadir tapi untuk bergerak, berbuat, dan memberi dampak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Guide Section (Cara Bergabung) -->
    <section id="guide" class="guide-section animate-on-scroll">
        <div class="section-header" style="text-align: center; margin-bottom: 50px;">
            <h2 class="section-title" style="font-size: 2.5rem; color: var(--primary);">Cara Bergabung</h2>
            <p class="section-subtitle">Ikuti 3 langkah mudah untuk menjadi bagian dari AORTA Malang</p>
        </div>
        
        <div class="guide-steps">
            <!-- Step 1 -->
            <div class="guide-step">
                <div class="step-number" style="position:absolute; top:15px; left:15px; width:35px; height:35px; background:var(--primary); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center;">1</div>
                <div class="step-icon" style="font-size:2rem; color:var(--primary); margin-bottom:20px;">
                    <i class="fab fa-instagram"></i>
                </div>
                <div class="step-content">
                    <h3>Follow Instagram Kami</h3>
                    <p>Follow Instagram resmi AORTA Malang untuk mendapatkan informasi terbaru tentang open recruitment dan kegiatan kami.</p>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="guide-step">
                <div class="step-number" style="position:absolute; top:15px; left:15px; width:35px; height:35px; background:var(--primary); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center;">2</div>
                <div class="step-icon" style="font-size:2rem; color:var(--primary); margin-bottom:20px;">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="step-content">
                    <h3>Tunggu Open Batch</h3>
                    <p>Pantau pengumuman open batch yang akan diposting di Instagram kami. Biasanya dilakukan setiap 6 bulan sekali.</p>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="guide-step">
                <div class="step-number" style="position:absolute; top:15px; left:15px; width:35px; height:35px; background:var(--primary); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center;">3</div>
                <div class="step-icon" style="font-size:2rem; color:var(--primary); margin-bottom:20px;">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="step-content">
                    <h3>Ikuti Seleksi</h3>
                    <p>Setelah mendaftar melalui form yang disediakan, tunggu seleksi administratif dan informasi interview user akan dikirimkan melalui email/whatsapp AORTA Malang.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Section -->
    <section class="login-section animate-on-scroll">
        <div class="login-container">
            <div class="login-header" style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: var(--primary); border-bottom: none; margin-bottom: 10px;">Login Admin</h2>
                <p>Login hanya untuk admin</p>
            </div>
            
            <form class="login-form" id="loginForm" action="{{ route('login.post') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #f5c6cb; font-size: 0.9rem;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                        <strong>Ups!</strong> {{ $errors->first() }}
                    </div>
                @endif
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="email" style="display:block; margin-bottom:8px; font-weight:600;">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="masukkan email anda" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px;">
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="password" style="display:block; margin-bottom:8px; font-weight:600;">Password</label>
                    <input type="password" id="password" name="password" placeholder="masukkan password anda" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px;">
                </div>
                
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.about-card');
        const contentDisplay = document.getElementById('about-content');
        const contentItems = document.querySelectorAll('.content-item');

        cards.forEach(card => {
            card.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                
                // If clicking the same active card, just toggle it off
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                    contentDisplay.style.display = 'none';
                    return;
                }

                // Remove active class from all cards and items
                cards.forEach(c => c.classList.remove('active'));
                contentItems.forEach(i => i.classList.remove('active'));

                // Add active class to clicked card
                this.classList.add('active');

                // Show display area
                contentDisplay.style.display = 'block';

                // Show target content item
                const targetItem = document.getElementById(targetId);
                if (targetItem) {
                    targetItem.classList.add('active');
                }

                // Smooth scroll to content if needed
                contentDisplay.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        });

        // Scroll to login form if there are login errors
        @if($errors->any())
            const loginSection = document.querySelector('.login-section');
            if (loginSection) {
                setTimeout(() => {
                    loginSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 500);
            }
        @endif
    });
</script>
@endpush
