@extends('layouts.app')

@section('title', 'Semua Artikel - AORTA Malang')

@push('styles')
<style>
    /* Header - Expanded slightly for title */
    header {
        background: var(--primary);
        min-height: 220px !important; /* Diperlebar sedikit */
        padding-top: 1rem !important;
        height: auto !important;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        position: relative;
    }

    /* Override standardized header content height */
    .header-content {
        min-height: auto !important;
        padding-bottom: 0 !important;
        height: auto !important;
        width: 100%;
    }

    /* Navbar positioning */
    .navbar {
        margin-bottom: 2rem !important;
        position: sticky !important;
        top: 20px !important;
        z-index: 1000;
        width: 90%;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Navbar sticky state adjustment via JS class usually, but basic sticky needs top */
    
    /* Hero Text Container - Repurposed for simple title */
    .hero-text-container {
        display: block !important;
        position: relative !important;
        top: auto !important;
        left: auto !important;
        transform: none !important;
        margin-top: 1rem;
        padding-bottom: 2rem;
        max-width: 100%;
    }
    
    .page-title-header {
        color: white;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .page-subtitle-header {
        color: rgba(255,255,255,0.8);
        font-size: 1rem;
        margin-bottom: 0;
    }

    /* Page Container */
    .articles-list-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 2rem 5rem;
    }

    /* Page title in body removed */
    .page-title, .page-subtitle {
        display: none;
    }
    
    /* Articles Grid - 3 columns */
    .articles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-bottom: 3rem;
    }

    /* Article Card */
    .article-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        display: flex;
        flex-direction: column;
    }

    .article-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .article-img-box {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .article-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .article-card:hover .article-img {
        transform: scale(1.1);
    }

    .article-tag {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--accent);
        color: var(--dark);
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .article-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .article-date {
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 0.5rem;
    }

    .article-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.8rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-excerpt {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-author {
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

    .article-author i {
        color: var(--primary);
        font-size: 1rem;
    }

    .article-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }
    
    .article-link:hover {
        gap: 10px;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    /* Target the bootstrap generated structure */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 0.5rem;
        align-items: center;
    }

    .page-item {
        margin: 0;
    }

    .page-link {
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
        text-decoration: none;
    }

    .page-item:first-child .page-link, 
    .page-item:last-child .page-link {
        border-radius: 50%; /* Override bootstrap rounded corners for first/last */
    }

    .page-item .page-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
        background: white;
    }

    .page-item.active .page-link {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        box-shadow: 0 5px 15px rgba(21, 64, 105, 0.3);
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
        border-color: #eee;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .empty-state i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #888;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .articles-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .articles-grid {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('hero')
    <div class="hero-text-container">
        <h1 class="page-title-header">Daftar Artikel</h1>
        <p class="page-subtitle-header">Artikel diurutkan dari yang terbaru</p>
    </div>
@endsection

@section('content')
    <div class="articles-list-container">
        
        <!-- Search Section -->
        <div class="search-section" style="margin-bottom: 3rem; background: #f8f9fa; padding: 1.5rem; border-radius: 16px; border: 1px solid #e9ecef;">
            <form action="{{ route('articles.all') }}" method="GET" style="display: flex; gap: 10px; max-width: 600px; margin: 0 auto;">
                <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}" style="flex: 1; padding: 12px 20px; border: 1px solid #ced4da; border-radius: 50px; outline: none; transition: border-color 0.2s;">
                <button type="submit" class="btn" style="background: var(--primary); color: white; border-radius: 50px; padding: 0 30px; font-weight: 600; border: none; cursor: pointer; transition: background 0.2s;">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>

        @if($articles->count() > 0)
            <div class="articles-grid">
                @foreach($articles as $article)
                    <article class="article-card">
                        <div class="article-img-box">
                            @if($article->image)
                                <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="article-img">
                            @else
                                <img src="{{ asset('img/default.jpg') }}" alt="{{ $article->title }}" class="article-img">
                            @endif
                            @if($article->tags)
                                @php
                                    $tags = json_decode($article->tags);
                                    $firstTag = is_array($tags) && count($tags) > 0 ? $tags[0] : null;
                                @endphp
                                @if($firstTag)
                                    <span class="article-tag">{{ $firstTag }}</span>
                                @endif
                            @endif
                        </div>
                        <div class="article-content">
                            <div class="article-date">
                                <i class="far fa-calendar-alt"></i> 
                                {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : $article->created_at->format('d M Y') }}
                            </div>
                            <h3 class="article-title">{{ $article->title }}</h3>
                            <p class="article-excerpt">{{ $article->description }}</p>
                            <div class="article-author">
                                <i class="fas fa-user-circle"></i> 
                                <span>{{ $article->author }}</span>
                            </div>
                            <a href="{{ route('articles.show', $article) }}" class="article-link">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $articles->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h3>Belum Ada Artikel</h3>
                <p>Artikel akan segera tersedia. Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>
@endsection
