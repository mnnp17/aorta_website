@extends('layouts.admin')

@section('title', 'Edit Article - Aorta Malang')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Artikel</h1>
    <a href="{{ route('admin.articles.index') }}" class="btn-cancel" style="text-decoration:none; padding:8px 15px; font-size:0.9rem;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="modal-content" style="max-width: 800px; margin: 0; position: static; transform: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Judul Artikel</label>
            <input type="text" id="title" name="title" required value="{{ old('title', $article->title) }}" class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <div class="invalid-feedback" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Singkat</label>
            <textarea id="description" name="description" rows="3" required class="form-control @error('description') is-invalid @enderror">{{ old('description', $article->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Konten Lengkap</label>
            <textarea id="content" name="content" rows="10" required class="form-control @error('content') is-invalid @enderror">{{ old('content', $article->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="image">Gambar Utama</label>
            @if($article->image)
                <div style="margin-bottom:10px;">
                    <img src="{{ asset($article->image) }}" style="max-height:150px; border-radius:8px;">
                </div>
            @endif
            <div class="image-upload-container">
                <input type="file" id="image" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
            </div>
            <small style="color:#777;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            @error('image')
                <div class="invalid-feedback" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" id="author" name="author" required value="{{ old('author', $article->author) }}" class="form-control @error('author') is-invalid @enderror">
            @error('author')
                <div class="invalid-feedback" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tags">Kategori Artikel</label>
            @php
                // Clean the stored tags format
                $currentTag = $article->tags;
                // If it's stored as JSON array ["tag"], take the first one
                if (str_starts_with($currentTag, '[')) {
                    $decoded = json_decode($currentTag, true);
                    $currentTag = $decoded[0] ?? '';
                }
                // If it's comma separated, take first
                if (str_contains($currentTag, ',')) {
                    $parts = explode(',', $currentTag);
                    $currentTag = trim($parts[0]);
                }
                // Also remove double quotes if they exist in string form
                $currentTag = trim($currentTag, '"'); 
            @endphp
            <select id="tags" name="tags" class="form-control" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                <option value="">Pilih Kategori</option>
                <option value="Kesehatan Mental" {{ (old('tags') ?? $currentTag) == 'Kesehatan Mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                <option value="Kesehatan Reproduksi" {{ (old('tags') ?? $currentTag) == 'Kesehatan Reproduksi' ? 'selected' : '' }}>Kesehatan Reproduksi</option>
                <option value="PHBS" {{ (old('tags') ?? $currentTag) == 'PHBS' ? 'selected' : '' }}>PHBS</option>
                <option value="Gizi Remaja" {{ (old('tags') ?? $currentTag) == 'Gizi Remaja' ? 'selected' : '' }}>Gizi Remaja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="published_at">Tanggal Publikasi</label>
            <input type="date" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d') : '') }}" class="form-control @error('published_at') is-invalid @enderror">
            @error('published_at')
                <div class="invalid-feedback" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Update Artikel</button>
        </div>
    </form>
</div>
@endsection
