@extends('layouts.app')

@section('title', 'Projects - AORTA Malang')

@push('styles')
<style>
    /* CSS INTERNAL - IMMERSIVE OVERLAP STYLE */
    
    /* 1. IMMERSIVE HEADER (Restored) */
    header {
        background-image: linear-gradient(rgba(21, 64, 105, 0.7), rgba(21, 64, 105, 0.8)), url('{{ asset('img/Peka.JPG') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 65vh; /* Taller to allow overlap */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding-bottom: 80px; /* Space for overlap */
        position: relative;
    }

    .hero-text-container {
        position: relative;
        transform: none;
        top: auto; left: auto;
        max-width: 900px;
        margin-top: -50px; /* Push up slightly */
        animation: fadeInDown 1s ease;
    }

    .tagline {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        color: white;
    }

    .tagline-sub {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.95;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        color: white;
        font-weight: 400;
    }

    /* 2. OVERLAPPING FEATURED CARD */
    .overlap-section {
        position: relative;
        margin-top: -120px; /* The Negative Margin Magic */
        padding: 0 2rem;
        z-index: 10;
        margin-bottom: 5rem;
    }

    .featured-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        max-width: 1200px;
        margin: 0 auto;
        overflow: hidden;
        display: flex;
        min-height: 500px;
        animation: fadeInUp 1s ease 0.3s forwards;
        opacity: 0;
        transform: translateY(30px);
    }

    .featured-info {
        flex: 1;
        padding: 4rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .featured-badge {
        background: var(--accent);
        color: var(--dark);
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        align-self: flex-start;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .featured-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .featured-desc {
        color: #555;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 2.5rem;
    }

    .stats-row {
        display: flex;
        gap: 3rem;
        margin-bottom: 2.5rem;
        border-top: 1px solid #eee;
        padding-top: 2rem;
    }

    .stat h4 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .stat p {
        margin: 0;
        font-size: 0.9rem;
        color: #888;
    }

    .btn-main {
        padding: 1rem 2.5rem;
        background: var(--primary);
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        align-self: flex-start;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(21, 64, 105, 0.2);
    }

    .btn-main:hover {
        background: var(--dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(21, 64, 105, 0.3);
    }

    .featured-img-wrap {
        flex: 1.2;
        position: relative;
        overflow: hidden;
    }

    .featured-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .featured-card:hover .featured-img {
        transform: scale(1.05);
    }

    /* 3. CLEAN PROJECT GRID */
    .projects-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem 6rem;
    }

    .controls-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-title-clean {
        font-size: 2.2rem;
        color: var(--dark);
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .clean-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2.5rem;
        margin-bottom: 4rem;
    }

    .clean-card {
        border-radius: 16px;
        background: white;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        display: flex;
        flex-direction: column;
    }

    .clean-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    .clean-img-box {
        height: 240px;
        overflow: hidden;
        position: relative;
    }

    .clean-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .clean-card:hover .clean-img {
        transform: scale(1.1);
    }

    /* .clean-cat removed */

    .clean-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .clean-date {
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 0.5rem;
    }

    .clean-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.8rem;
        line-height: 1.3;
    }

    .clean-excerpt {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
    }

    .clean-project-manager {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #555;
        background: #f8f9fa;
        padding: 8px 12px;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    .clean-project-manager i {
        color: var(--primary);
        font-size: 1rem;
    }

    .clean-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .clean-link:hover {
        gap: 10px;
        transition: gap 0.2s;
    }

    /* PAGINATION STYLES */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        gap: 0.8rem;
        align-items: center;
    }

    .page-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 1px solid #e1e4e8;
        background: white;
        color: var(--dark);
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        font-size: 1rem;
    }

    .page-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
    }

    .page-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        box-shadow: 0 5px 15px rgba(21, 64, 105, 0.3);
    }

    .page-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
        border-color: #eee;
    }

    /* Keyframes */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .featured-card {
            flex-direction: column-reverse;
            max-width: 600px;
        }
        
        .featured-img-wrap {
            height: 300px;
            flex: none;
        }
        
        .featured-info {
            padding: 2.5rem;
        }
        
        .featured-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 768px) {
        .tagline {
            font-size: 2.5rem;
        }
        
        .overlap-section {
            margin-top: -80px;
            padding: 0 1rem;
        }
        
        .clean-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('hero')
    <div class="hero-text-container">
        <h1 class="tagline">Inovasi & Aksi Nyata</h1>
        <p class="tagline-sub">Temukan berbagai proyek inovatif AORTA Malang dalam mendorong perubahan positif untuk kesehatan remaja di Indonesia.</p>
    </div>
@endsection

@section('content')
    <!-- OVERLAPPING FEATURED SECTION -->
    <section class="overlap-section">
        @if($featuredProject)
        <div class="featured-card">
            <div class="featured-info">
                <span class="featured-badge">Newest Project</span>
                <h2 class="featured-title">{{ $featuredProject->title }}</h2>
                <p class="featured-desc">
                    {{ $featuredProject->description }}
                </p>
                <a href="{{ route('projects.show', $featuredProject) }}" class="btn-main">Lihat Detail <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="featured-img-wrap">
                <img src="{{ $featuredProject->image ? asset($featuredProject->image) : asset('img/default.jpg') }}" alt="{{ $featuredProject->title }}" class="featured-img">
            </div>
        </div>
        @else
        <div class="featured-card">
             <div class="featured-info">
                <p>Belum ada proyek yang ditambahkan.</p>
             </div>
        </div>
        @endif
    </section>

    <!-- CLEAN PROJECTS GRID -->
    <div class="projects-container">
        <div class="controls-header">
            <h2 class="section-title-clean">Semua Proyek</h2>
            <!-- Clean header without filters -->
        </div>

        <div class="clean-grid" id="projectsGrid">
            <!-- JS RENDERED -->
        </div>
        
        <!-- PAGINATION CONTROLS -->
        <div class="pagination-wrapper" id="paginationControls">
            <!-- Generated by JS -->
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- DATA PROJECTS (From Controller) ---
        const projects = @json($mappedProjects);

        // --- CONFIGURATION ---
        const itemsPerPage = 4;
        let currentPage = 1;
        const totalPages = Math.ceil(projects.length / itemsPerPage);

        // --- DOM ELEMENTS ---
        const grid = document.getElementById('projectsGrid');
        const paginationContainer = document.getElementById('paginationControls');

        // --- RENDER GRID ---
        function renderProjects(page) {
            grid.innerHTML = '';
            
            // Slice Data
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedItems = projects.slice(start, end);

            paginatedItems.forEach((item, index) => {
                const card = document.createElement('div');
                card.className = 'clean-card';
                // Staggered animation based on index (0-3)
                card.style.animation = `fadeInUp 0.5s ease forwards ${index * 0.1}s`;
                card.style.opacity = '0';
                
                card.innerHTML = `
                    <div class="clean-img-box">
                        <img src="${item.image}" alt="${item.title}" class="clean-img">
                    </div>
                    <div class="clean-content">
                        <div class="clean-date">${item.date}</div>
                        <h3 class="clean-title">${item.title}</h3>
                        <p class="clean-excerpt">${item.excerpt}</p>
                        <div class="clean-project-manager">
                            <i class="fas fa-user-circle"></i> <span>Project Manager: ${item.leader}</span>
                        </div>
                        <a href="${item.url}" class="clean-link">Detail Proyek <i class="fas fa-arrow-right"></i></a>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        // --- RENDER PAGINATION ---
        function renderPagination() {
            paginationContainer.innerHTML = '';

            // Prev Button
            const prevBtn = createPageBtn('<i class="fas fa-chevron-left"></i>', currentPage > 1, () => changePage(currentPage - 1));
            paginationContainer.appendChild(prevBtn);

            // Numbered Buttons
            for (let i = 1; i <= totalPages; i++) {
                const btn = createPageBtn(i, true, () => changePage(i));
                if (i === currentPage) {
                    btn.classList.add('active');
                }
                paginationContainer.appendChild(btn);
            }

            // Next Button
            const nextBtn = createPageBtn('<i class="fas fa-chevron-right"></i>', currentPage < totalPages, () => changePage(currentPage + 1));
            paginationContainer.appendChild(nextBtn);
        }

        function createPageBtn(content, isEnabled, onClick) {
            const btn = document.createElement('button');
            btn.className = 'page-btn';
            btn.innerHTML = content;
            if (!isEnabled) {
                btn.classList.add('disabled');
            } else {
                btn.addEventListener('click', onClick);
            }
            return btn;
        }

        function changePage(newPage) {
            if (newPage < 1 || newPage > totalPages) return;
            currentPage = newPage;
            renderProjects(currentPage);
            renderPagination();
            
            // Smooth Scroll to Top of Grid
            const headerOffset = 100;
            const elementPosition = document.querySelector('.controls-header').getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });
        }

        // --- INITIAL RENDER ---
        renderProjects(currentPage);
        renderPagination();
    });
</script>
@endpush
