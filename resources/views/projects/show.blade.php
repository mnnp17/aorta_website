@extends('layouts.app')

@section('title', $project->title . ' - AORTA Malang')

@push('styles')
<style>
    /* Project Detail Styles (Adapted from Article) */
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

    .project-container {
        max-width: 800px;
        margin: -5rem auto 5rem;
        padding: 0 1.5rem;
        position: relative;
        z-index: 10;
    }

    .project-header {
        background: white;
        padding: 2.5rem;
        border-radius: 16px 16px 0 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        text-align: center;
    }

    .project-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        color: #777;
        font-size: 0.9rem;
        flex-wrap: wrap;
    }

    .project-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .project-meta-item i {
        color: var(--primary);
    }

    .project-title {
        font-size: 2.5rem;
        color: var(--dark);
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }

    .project-featured-image {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border-radius: 0 0 16px 16px;
        margin-bottom: 3rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .project-content {
        background: white;
        padding: 3rem;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        font-size: 1.1rem;
        line-height: 1.8;
        color: #444;
    }

    .project-content p {
        margin-bottom: 1.5rem;
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
</style>
@endpush

@section('hero')
    <div style="max-width: 800px; margin: 0 auto; width: 100%;">
        <a href="{{ route('projects.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Proyek
        </a>
    </div>
@endsection

@section('content')
    <div class="project-container">
        <div class="project-header">
            <div class="project-meta">
                <div class="project-meta-item">
                    <i class="far fa-calendar-alt"></i>
                    {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M Y') : $project->created_at->format('M Y') }}
                </div>
                <div class="project-meta-item">
                    <i class="fas fa-user-circle"></i>
                    Project Manager: {{ $project->project_leader }}
                </div>
            </div>
            <h1 class="project-title">{{ $project->title }}</h1>
        </div>

        @if($project->image)
            <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="project-featured-image">
        @else
            <img src="{{ asset('img/default.jpg') }}" alt="{{ $project->title }}" class="project-featured-image">
        @endif

        <div class="project-content">
            {!! $project->description !!}
        </div>
    </div>
@endsection
