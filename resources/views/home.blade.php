@extends('layouts.app')

@section('title', 'AORTA Malang - Belajar, Berkembang, dan Bertindak Bersama')

@push('styles')
<style>
    /* CSS INTERNAL KHUSUS HOMEPAGE SAJA */
    
    /* Header Styles - Home Page Specific (Background Only) */
    header {
        background-image: linear-gradient(rgba(21, 64, 105, 0.5), rgba(21, 64, 105, 0.5)), url('{{ asset('img/bghome.png') }}');
    }
    
    /* About Section */
    .about-content {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
    }
    
    .about-text {
        flex: 1;
        min-width: 300px;
        text-align: justify;
    }
    
    .stats {
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        background-color: var(--light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--primary);
        font-size: 1.5rem;
    }
    
    .stat-text {
        flex: 1;
    }
    
    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary);
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: var(--text);
    }
    
    /* Issues Section */
    .issues-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .issue-card {
        background-color: var(--primary);
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary);
    }
    
    .issue-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    
    .issue-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--light);
    }
    
    .issue-title {
        font-weight: 600;
        color: var(--light);
        margin-bottom: 0.5rem;
    }
    
    /* Community Partners Section - DIREVISI */
    .partners-section {
        padding: 4rem 2rem;
        background-color: white;
        overflow: hidden; /* Ensure no scrollbar */
    }

    .partners-section h2 {
        text-align: center;
        margin-bottom: 3rem;
        color: var(--primary);
    }

    .partners-container-wrapper {
        overflow: hidden;
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        border-radius: 10px;
        padding: 2rem 0;
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }

    .partners-track {
        display: flex;
        width: max-content;
        /* Animation duration: 13 items. Speed = distance / time. 
           Adjust time (40s) as needed for smoothness. */
        animation: slide 30s linear infinite;
    }

    .partner-item {
        flex: 0 0 200px; /* Width */
        margin: 0 1rem;  /* Margin: 16px left + 16px right = 32px total space */
        text-align: center;
        transition: all 0.3s ease;
    }
    /* Total width per item = 232px */

    .partner-item:hover {
        transform: translateY(-5px);
    }

    .partner-logo-frame {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background-color: white;
        margin: 0 auto 1rem;
        padding: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 3px solid var(--primary);
        transition: all 0.3s ease;
    }

    .partner-item:hover .partner-logo-frame {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        border-color: var(--secondary);
    }

    .partner-logo {
        width: 80%;
        height: 80%;
        object-fit: contain;
        border-radius: 50%;
    }

    .partner-name {
        font-weight: 600;
        color: var(--primary);
        font-size: 0.9rem;
        margin-top: 0.5rem;
        min-height: 2.5em;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Animation: Slide 13 items exactly */
    @keyframes slide {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-232px * 13)); } /* 200px width + 32px margin */
    }

    /* Pause animation on hover */
    .partners-container-wrapper:hover .partners-track {
        animation-play-state: paused;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .partner-item {
            flex: 0 0 180px; /* 180px width */
        }
        /* Margin remains 0 1rem (32px). Total = 212px */
        
        .partner-logo-frame {
            width: 120px;
            height: 120px;
        }
        
        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-212px * 13)); }
        }
    }

    @media (max-width: 768px) {
        .partners-section {
            padding: 3rem 1rem;
        }
        
        .partners-container-wrapper {
            max-width: 100%;
            padding: 1.5rem 0;
            mask-image: none; /* Often better on mobile to show full scrolling */
            -webkit-mask-image: none;
        }
        
        .partner-item {
            flex: 0 0 150px; /* 150px width */
            margin: 0 0.75rem; /* 12px + 12px = 24px */
        }
        /* Total = 174px */
        
        .partner-logo-frame {
            width: 100px;
            height: 100px;
        }
        
        .partner-name {
            font-size: 0.8rem;
        }
        
        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-174px * 13)); }
        }

        .about-content {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .partner-item {
            flex: 0 0 130px; /* 130px width */
            margin: 0 0.5rem; /* 8px + 8px = 16px */
        }
        /* Total = 146px */
        
        .partner-logo-frame {
            width: 90px;
            height: 90px;
            padding: 10px;
        }
        
        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-146px * 13)); }
        }
    }
</style>
@endpush

@section('hero')
    <div class="hero-text-container">
        <div class="tagline">Learn, Grow, and Act Together</div>
        <a href="#about" class="learn-more-btn">Pelajari Lebih Lanjut</a>
    </div>
@endsection

@section('content')
    <section id="about" class="about-section">
        <h2>Tentang AORTA Malang</h2>
        <div class="about-content">
            <div class="about-text">
                <p>Aksi Solidaritas Remaja Kesehatan Astra atau yang dikenal dengan AORTA Community merupakan suatu komunitas binaan PT. Astra Internasional Tbk yang memiliki kepedulian terhadap isu-isu kesehatan remaja di Indonesia. AORTA dikukuhkan untuk pertama kalinya pada tanggal 21 November 2019 di Belitung oleh Chief of Corporate Affair Astra Bapak Riza Deliansyah didampingi oleh Deputi Pencegahan BNN Bapak Drs. Anjan Pramuka Putra, SH. M. Hum dan Sekretaris utama BKKBN Bapak H. Nofrizal, S. P, MA.</p>
                <p>AORTA Malang didirikan bersamaan dengan penunjukan Ulfi Sa’adah selaku president community.  Anggota AORTA terdiri atas mahasiswa dari berbagai universitas yang ada di Kota Malang. Event yang dilaksanakan oleh AORTA Malang berhasil menggaet audiens siswa SD/SMP/SMA dan mahasiswa. Proyek yang dilaksanakan selain berfokus pada health awareness, juga berfokus pada self development. AORTA Malang dipimpin oleh 1 President, 1 Vice, 2 Unit Support (IT Team dan Human Resources), serta 4 departemen operasional meliputi Event Operational, Administrative, Public Relation and Marketing, dan Media Creative, and Design.</p>
            </div>
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-icon">👥</div>
                    <div class="stat-text">
                        <div class="stat-number">25</div>
                        <div class="stat-label">Anggota Pengurus</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">🎯</div>
                    <div class="stat-text">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Peserta Acara</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">📋</div>
                    <div class="stat-text">
                        <div class="stat-number">{{ $projectCount }}</div>
                        <div class="stat-label">Proyek Dilaksanakan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="issues" class="issues-section">
        <h2>Fokus Isu</h2>
        <div class="issues-grid">
            <div class="issue-card">
                <div class="issue-icon"><i class="fas fa-female"></i></div>
                <div class="issue-title">KESEHATAN REPRODUKSI</div>
            </div>
            <div class="issue-card">
                <div class="issue-icon"><i class="fas fa-brain"></i></div>
                <div class="issue-title">KESEHATAN MENTAL</div>
            </div>
            <div class="issue-card">
                <div class="issue-icon"><i class="fas fa-hand-sparkles"></i></div>
                <div class="issue-title">PERILAKU HIDUP BERSIH & SEHAT</div>
            </div>
            <div class="issue-card">
                <div class="issue-icon"><i class="fas fa-apple-alt"></i></div>
                <div class="issue-title">GIZI REMAJA</div>
            </div>
        </div>
    </section>

    <!-- Community Partners Section -->
    <section id="partners" class="partners-section">
        <h2>Community Partners</h2>
        <div class="partners-container-wrapper">
            <div class="partners-track">
                {{-- ORIGINAL 13 ITEMS --}}
                @foreach([
                    ['img' => 'compart1.png', 'name' => 'Pemimpin.indonesia'],
                    ['img' => 'compart2.png', 'name' => 'Dari Mata Kaki'],
                    ['img' => 'compart3.png', 'name' => 'Peta Careers'],
                    ['img' => 'compart4.png', 'name' => 'Creative Center'],
                    ['img' => 'compart5.jpg', 'name' => 'Duta Psikologi UIN Malang'],
                    ['img' => 'compart6.jpg', 'name' => 'FYI Pshycology'],
                    ['img' => 'compart7.PNG', 'name' => 'YOT'],
                    ['img' => 'compart8.png', 'name' => 'Path Seeker'],
                    ['img' => 'compart9.PNG', 'name' => 'Teman Manusia Malang'],
                    ['img' => 'Logo IBM Biru.png', 'name' => 'IBM'],
                    ['img' => 'Tenggara.jpeg', 'name' => 'Tenggara'],
                    ['img' => 'ISJ.PNG', 'name' => 'ISJ'],
                    ['img' => 'Biyung.PNG', 'name' => 'Biyung'],
                ] as $partner)
                <div class="partner-item">
                    <div class="partner-logo-frame">
                        <img src="{{ asset('img/' . $partner['img']) }}" alt="{{ $partner['name'] }}" class="partner-logo">
                    </div>
                    <div class="partner-name">{{ $partner['name'] }}</div>
                </div>
                @endforeach

                {{-- DUPLICATE FOR INFINITE LOOP --}}
                @foreach([
                     ['img' => 'compart1.png', 'name' => 'Pemimpin.indonesia'],
                    ['img' => 'compart2.png', 'name' => 'Dari Mata Kaki'],
                    ['img' => 'compart3.png', 'name' => 'Peta Careers'],
                    ['img' => 'compart4.png', 'name' => 'Creative Center'],
                    ['img' => 'compart5.jpg', 'name' => 'Duta Psikologi UIN Malang'],
                    ['img' => 'compart6.jpg', 'name' => 'FYI Pshycology'],
                    ['img' => 'compart7.PNG', 'name' => 'YOT'],
                    ['img' => 'compart8.png', 'name' => 'Path Seeker'],
                    ['img' => 'compart9.PNG', 'name' => 'Teman Manusia Malang'],
                    ['img' => 'Logo IBM Biru.png', 'name' => 'IBM'],
                    ['img' => 'Tenggara.jpeg', 'name' => 'Tenggara'],
                    ['img' => 'ISJ.PNG', 'name' => 'ISJ'],
                    ['img' => 'Biyung.PNG', 'name' => 'Biyung'],
                ] as $partner)
                <div class="partner-item">
                    <div class="partner-logo-frame">
                        <img src="{{ asset('img/' . $partner['img']) }}" alt="{{ $partner['name'] }}" class="partner-logo">
                    </div>
                    <div class="partner-name">{{ $partner['name'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Community Partners Slider - REVISI SEDERHANA
        const partnersWrapper = document.querySelector('.partners-container-wrapper');
        const partnersTrack = document.querySelector('.partners-track');
        
        if (partnersTrack) {
            // Hentikan animasi saat hover, lanjutkan saat mouse leave
            partnersWrapper.addEventListener('mouseenter', () => {
                partnersTrack.style.animationPlayState = 'paused';
            });
            
            partnersWrapper.addEventListener('mouseleave', () => {
                partnersTrack.style.animationPlayState = 'running';
            });
        }
        
        // Observer untuk animasi fade in section partners
        const partnersSection = document.querySelector('.partners-section');
        if (partnersSection) {
            partnersSection.style.opacity = '0';
            partnersSection.style.transform = 'translateY(20px)';
            partnersSection.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            
            const sectionObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            sectionObserver.observe(partnersSection);
        }
    });
</script>
@endpush
