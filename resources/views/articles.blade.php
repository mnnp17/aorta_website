@extends('layouts.app')

@section('title', 'Artikel - AORTA Malang')

@push('styles')
<style>
    /* CSS INTERNAL KHUSUS ARTICLES PAGE */
    
    /* Header Styles Override - Articles Page (Modern & Interactive) */
    header {
        background-image: linear-gradient(rgba(21, 64, 105, 0.4), rgba(21, 64, 105, 0.6)), url('{{ asset('img/Girls support.JPG') }}');
        background-position: center 85%;
        background-attachment: fixed;
    }

    .hero-text-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 1000px;
        z-index: 10;
        padding: 0 1rem;
        /* Shifted down to avoid navbar */
        margin-top: 50px; 
        animation: fadeInUp 1s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .hero-eyebrow {
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--accent);
        opacity: 0.95;
        display: block;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        color: white;
        text-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .hero-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 1.15rem;
        font-weight: 400;
        max-width: 800px;
        margin: 0 auto 3rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.9);
    }

    .modern-cta {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary) 0%, #2c5aa0 100%);
        padding: 1rem 3rem;
        font-size: 1.1rem;
        border-radius: 50px;
        border: none;
        color: white;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        display: inline-block;
    }

    .modern-cta:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        background: linear-gradient(135deg, #2c5aa0 0%, var(--primary) 100%);
    }

    .modern-cta::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: all 0.6s;
    }

    .modern-cta:hover::before {
        left: 100%;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .hero-glass-card {
            padding: 3rem 1.5rem;
        }
        .hero-title {
            font-size: 2.2rem;
        }
        .hero-subtitle {
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .modern-cta {
            padding: 0.8rem 2rem;
            font-size: 1rem;
        }
    }

    /* ... Copied styles from articles.html ... */
    
    h2 {
        color: var(--primary);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--accent);
        font-size: 1.8rem;
    }

    h3 {
        color: var(--dark);
        margin: 1.5rem 0 1rem;
    }

    p {
        margin-bottom: 1rem;
    }

    /* Tombol Lihat Semua */
    .see-more-section {
        display: flex;
        justify-content: flex-end;
        margin-bottom: -2.5rem;
    }

    .see-more-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .see-more-btn:hover {
        background: #2c5aa0;
        transform: translateX(3px);
        box-shadow: 0 3px 10px rgba(21, 64, 105, 0.3);
    }

    .see-more-btn i {
        transition: transform 0.3s ease;
        font-size: 0.8rem;
    }

    .see-more-btn:hover i {
        transform: translateX(2px);
    }

    /* Artikel Styles */
    .articles-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .article-card {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-content {
        padding: 1.5rem;
    }

    .card-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        font-size: 0.85rem;
        color: #777;
    }

    .card-title {
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
        color: var(--primary);
        line-height: 1.4;
    }

    .card-excerpt {
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 1.2rem;
    }

    .card-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
    }

    .card-link::after {
        content: '→';
        margin-left: 0.3rem;
        transition: transform 0.3s;
    }

    .card-link:hover::after {
        transform: translateX(3px);
    }

    /* Featured Article */
    .featured-article {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-bottom: 3rem;
        background-color: white;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .featured-image {
        flex: 1;
        min-width: 300px;
    }

    .featured-img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .featured-content {
        flex: 2;
        min-width: 300px;
    }

    .article-meta {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: #777;
        font-size: 0.9rem;
    }

    .article-date {
        background-color: var(--primary);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 4px;
        font-weight: 500;
        margin-right: 1rem;
    }

    .article-category {
        color: var(--primary);
        font-weight: 500;
    }

    .article-title {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: var(--primary);
    }

    .article-excerpt {
        color: #555;
        margin-bottom: 1.5rem;
    }

    .read-more {
        display: inline-block;
        background-color: var(--primary);
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .read-more:hover {
        background-color: #2c5aa0;
    }

    /* Sidebar */
    .sidebar {
        background-color: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        /* Override fixed sidebar from admin */
        width: auto;
        position: static;
        height: auto;
        display: block; 
    }

    .sidebar-title {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary);
        color: var(--primary);
    }

    .sidebar-articles {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-article {
        display: flex;
        gap: 1rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
    }

    .sidebar-article:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .sidebar-article-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }

    .sidebar-article-content {
        flex: 1;
    }

    .sidebar-article-date {
        font-size: 0.8rem;
        color: #777;
        margin-bottom: 0.3rem;
    }

    .sidebar-article-title {
        font-size: 1rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .sidebar-article-excerpt {
        font-size: 0.85rem;
        color: #777;
    }

    /* Main Content Layout */
    .layout-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    @media (max-width: 992px) {
        .layout-grid {
            grid-template-columns: 1fr;
        }

        .sidebar {
            order: -1;
        }
    }
</style>
@endpush

@section('hero')
    <div class="hero-text-container">
        <span class="hero-eyebrow">AORTA Malang Blog</span>
        <h1 class="hero-title">Wawasan & Aksi</h1>
        <p class="hero-subtitle">Temukan berbagai artikel seputar kegiatan AORTA Malang dan isu - isu seputar kesehatan lainnya untuk masa depan remaja yang lebih cerah.</p>
        <a href="#articles-section" class="modern-cta">Jelajahi Artikel</a>
    </div>
@endsection

@section('content')
    <section id="articles-section">
        <h2>Artikel Terbaru</h2>
        <div class="layout-grid">
            <!-- Artikel Utama -->
            @if($highlight)
            <section class="featured-article" style="margin-bottom: 0; padding: 0; box-shadow: none;">
                <div class="featured-image">
                    @if($highlight->image)
                        <img src="{{ asset($highlight->image) }}" alt="{{ $highlight->title }}" class="featured-img">
                    @else
                        <img src="{{ asset('img/default.jpg') }}" alt="{{ $highlight->title }}" class="featured-img">
                    @endif
                </div>
                <div class="featured-content">
                    <div class="article-meta">
                        <span class="article-date">{{ $highlight->published_at ? \Carbon\Carbon::parse($highlight->published_at)->format('d M Y') : $highlight->created_at->format('d M Y') }}</span>
                         @if($highlight->tags)
                            @php
                                $tags = json_decode($highlight->tags);
                                $firstTag = is_array($tags) && count($tags) > 0 ? $tags[0] : null;
                            @endphp
                            @if($firstTag)
                                <span class="article-category">{{ $firstTag }}</span>
                            @endif
                        @endif
                    </div>
                    <h2 class="article-title">{{ $highlight->title }}</h2>
                    <p class="article-excerpt">{{ Str::limit($highlight->description, 150) }}</p>
                    <a href="{{ route('articles.show', $highlight) }}" class="read-more">Baca Selengkapnya</a>
                </div>
            </section>
            @else
                <p>Belum ada artikel terbaru.</p>
            @endif

            <!-- Sidebar -->
            <aside class="sidebar">
                <h3 class="sidebar-title">Artikel Populer</h3>
                <div class="sidebar-articles">
                    @forelse($popular as $popArticle)
                    <div class="sidebar-article">
                        @if($popArticle->image)
                            <img src="{{ asset($popArticle->image) }}" alt="{{ $popArticle->title }}" class="sidebar-article-image">
                        @else
                            <img src="{{ asset('img/default.jpg') }}" alt="{{ $popArticle->title }}" class="sidebar-article-image">
                        @endif
                        <div class="sidebar-article-content">
                            <div class="sidebar-article-date">{{ $popArticle->published_at ? \Carbon\Carbon::parse($popArticle->published_at)->format('d M Y') : $popArticle->created_at->format('d M Y') }}</div>
                            <h4 class="sidebar-article-title"><a href="{{ route('articles.show', $popArticle) }}" style="color: inherit; text-decoration: none;">{{ Str::limit($popArticle->title, 50) }}</a></h4>
                            <p class="sidebar-article-excerpt" style="font-size: 0.8rem; margin-bottom: 0;">{{ $popArticle->views }} views</p>
                        </div>
                    </div>
                    @empty
                        <p>Belum ada artikel populer.</p>
                    @endforelse
                </div>
            </aside>
        </div>
    </section>

    <section>
        <div class="see-more-section">
            <a href="{{ route('articles.all') }}" class="see-more-btn">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <h2>Artikel Lainnya</h2>
        <div class="articles-container">
            @forelse($others as $otherArticle)
            <article class="article-card">
                @if($otherArticle->image)
                    <img src="{{ asset($otherArticle->image) }}" alt="{{ $otherArticle->title }}" class="card-image">
                @else
                    <img src="{{ asset('img/default.jpg') }}" alt="{{ $otherArticle->title }}" class="card-image">
                @endif
                <div class="card-content">
                    <div class="card-meta">
                        <span>{{ $otherArticle->published_at ? \Carbon\Carbon::parse($otherArticle->published_at)->format('d M Y') : $otherArticle->created_at->format('d M Y') }}</span>
                        <!-- You can add category/tags here if needed -->
                    </div>
                    <h3 class="card-title">{{ Str::limit($otherArticle->title, 60) }}</h3>
                    <p class="card-excerpt">{{ Str::limit($otherArticle->description, 100) }}</p>
                    <a href="{{ route('articles.show', $otherArticle) }}" class="card-link">Baca Selengkapnya</a>
                </div>
            </article>
            @empty
                <p>Belum ada artikel lainnya.</p>
            @endforelse
        </div>
    </section>
@endsection
