@extends('layouts.app')

@section('title', $article->title . ' - AORTA Malang')

@push('styles')
<style>
    /* Article Detail Styles */
    header {
        background: var(--primary);
        min-height: 220px !important;
        padding-top: 1rem !important;
        height: auto !important;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        position: relative;
    }

    .header-content {
        min-height: auto !important;
        padding-bottom: 0 !important;
    }

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

    .hero-text-container {
        display: none !important;
    }

    .article-container {
        max-width: 800px;
        margin: -5rem auto 5rem;
        padding: 0 1.5rem;
        position: relative;
        z-index: 10;
    }

    .article-header {
        background: white;
        padding: 2.5rem;
        border-radius: 16px 16px 0 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        text-align: center;
    }

    .article-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        color: #777;
        font-size: 0.9rem;
        flex-wrap: wrap;
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .article-meta-item i {
        color: var(--primary);
    }

    .article-tag {
        background: var(--accent);
        color: var(--dark);
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .article-title {
        font-size: 2.5rem;
        color: var(--dark);
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }

    .article-featured-image {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border-radius: 0 0 16px 16px;
        margin-bottom: 3rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .article-content {
        background: white;
        padding: 3rem;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        font-size: 1.1rem;
        line-height: 1.8;
        color: #444;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content h2, .article-content h3 {
        color: var(--dark);
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
        transition: transform 0.3s;
    }

    .back-btn:hover {
        transform: translateX(-5px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .article-title {
            font-size: 1.8rem;
        }

        .article-header {
            padding: 2rem 1.5rem;
        }

        .article-content {
            padding: 2rem 1.5rem;
        }
    }
</style>
@endpush

@section('hero')
    <div style="max-width: 800px; margin: 0 auto; width: 100%;">
        <a href="{{ route('articles') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Artikel
        </a>
    </div>
@endsection

@section('content')
    <div class="article-container">
        <div class="article-header">
            <div class="article-meta">
                <div class="article-meta-item">
                    <i class="far fa-calendar-alt"></i>
                    {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : $article->created_at->format('d M Y') }}
                </div>
                <div class="article-meta-item">
                    <i class="fas fa-user-circle"></i>
                    {{ $article->author }}
                </div>
                <div class="article-meta-item">
                    <i class="far fa-eye"></i>
                    {{ $article->views }} Views
                </div>
                @if($article->tags)
                    @php
                        $tags = json_decode($article->tags);
                    @endphp
                    @if(is_array($tags))
                        @foreach($tags as $tag)
                            <span class="article-tag">{{ $tag }}</span>
                        @endforeach
                    @else
                        <span class="article-tag">{{ $article->tags }}</span> <!-- Fallback if string -->
                    @endif
                @endif
            </div>
            <h1 class="article-title">{{ $article->title }}</h1>
        </div>

        @if($article->image)
            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="article-featured-image">
        @else
            <img src="{{ asset('img/default.jpg') }}" alt="{{ $article->title }}" class="article-featured-image">
        @endif

        <div class="article-content">
            {!! $article->content !!}
        </div>
    </div>
@endsection
