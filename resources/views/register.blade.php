@extends('layouts.app')

@section('title', 'Tentang Kami - AORTA Malang')

@push('styles')
<style>
    /* CSS INTERNAL KHUSUS REGISTER PAGE */
    
    /* Header Override - Register Page (Background Only) */
    header {
        background-image: linear-gradient(135deg, rgba(21, 64, 105, 0.9) 0%, rgba(26, 154, 169, 0.9) 100%), 
                    url('{{ asset('img/Peka%202.JPG') }}');
    }
    
    /* Register Page - Use standard centered layout, just different gradient text */
    .tagline {
        font-size: 2.2rem; /* Adjusted from 2.5rem */
        background: linear-gradient(to right, #ffffff, #e0f7fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-text-container {
        top: 58% !important; /* Move down to avoid navbar overlap */
        max-width: 1000px !important; /* Widen to keep "AORTA Malang" on one line */
    }

    /* Guide and Login Sections */
    .guide-section {
        padding: 80px 20px;
        background: white;
        margin: 3rem auto;
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
    
    .login-section {
        padding: 80px 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .login-container {
        max-width: 500px;
        margin: 0 auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    /* ... Other styles ... */
    
    @media (max-width: 992px) {
        .header-main-content {
            flex-direction: column;
            text-align: center;
        }
        .hero-text-container {
            text-align: center;
            margin-left: 0;
            margin-bottom: 40px;
            top: 62% !important; /* Move down on mobile too */
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
        <a href="https://www.instagram.com/aortacommunitymalang?igsh=MW9yZDA5M253ZXZzZw%3D%3D&utm_source=qr" class="learn-more-btn" target="_blank" rel="noopener noreferrer">
            Mulai Bergabung <i class="fas fa-arrow-right"></i>
        </a>
    </div>
@endsection

@section('content')
    <!-- User Guide Section -->
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
                <h2 style="color: var(--primary);">Login Admin</h2>
                <p>Login hanya untuk admin</p>
            </div>
            
            <form class="login-form" id="loginForm" action="{{ route('login.post') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div style="color: red; margin-bottom: 15px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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
                
                <button type="submit" class="login-button" style="width:100%; padding:12px; background:var(--primary); color:white; border:none; border-radius:6px; font-weight:600; cursor:pointer;">Login</button>
            </form>
        </div>
    </section>
@endsection
