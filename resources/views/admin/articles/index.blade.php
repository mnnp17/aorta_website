@extends('layouts.admin')

@section('title', 'Manage Articles - Aorta Malang')

@section('content')
<div class="page-header">
    <h1 class="page-title">Artikel</h1>
    <a href="{{ route('admin.articles.create') }}" class="btn-new-item">
        <i class="fas fa-plus"></i> New Artikel
    </a>
</div>

@if(session('success'))
<div id="success-alert" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; transition: opacity 0.5s ease-out;">
    {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500); // Wait for fade out transition
        }
    }, 5000);
</script>
@endif

<div class="search-bar" style="margin-bottom: 20px;">
    <form action="{{ route('admin.articles.index') }}" method="GET" style="display: flex; gap: 10px; max-width: 400px;">
        <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}" style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; flex: 1;">
        <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background-color: var(--primary); color: white; border: none; border-radius: 5px; cursor: pointer;">
            <i class="fas fa-search"></i> Cari
        </button>
    </form>
</div>

<div class="content-grid">
    @foreach($articles as $article)
    <div class="article-item">
        <div class="item-image">
            @if($article->image)
                <img src="{{ asset($article->image) }}" alt="{{ $article->title }}">
            @else
                <div style="width:100%; height:100%; background:#eee; display:flex; justify-content:center; align-items:center; color:#999;">No Image</div>
            @endif
        </div>
        <div class="item-details">
            @php
                $tags = $article->tags;
                if (empty($tags)) {
                    $tagDisplay = '';
                } elseif (str_starts_with($tags, '[')) {
                    $decoded = json_decode($tags, true);
                    $tagDisplay = $decoded[0] ?? '';
                } else {
                    // Fallback for plain string or comma separated
                    $parts = explode(',', $tags);
                    $tagDisplay = trim($parts[0]);
                }
            @endphp
            
            @if($tagDisplay)
                <span class="item-tag">{{ $tagDisplay }}</span>
            @endif
            
            <h3 class="item-title">{{ $article->title }}</h3>
            <div class="item-meta">
                <span>{{ $article->author }}</span>
                <span>{{ $article->created_at->format('d M Y') }}</span>
            </div>
            <p class="item-desc">{{ Str::limit($article->description, 100) }}</p>
            
            <div class="item-actions">
                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-action btn-edit" style="text-decoration:none; text-align:center;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="flex:1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete" style="width:100%;">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-wrapper" style="margin-top: 30px; display: flex; justify-content: center;">
    {{ $articles->withQueryString()->links('pagination::bootstrap-4') }}
</div>
@endsection
