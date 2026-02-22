@extends('layouts.admin')

@section('title', 'New Article - Aorta Malang')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Artikel Baru</h1>
    <a href="{{ route('admin.articles.index') }}" class="btn-cancel" style="text-decoration:none; padding:8px 15px; font-size:0.9rem;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="modal-content" style="max-width: 800px; margin: 0; position: static; transform: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Judul Artikel</label>
            <input type="text" id="title" name="title" required value="{{ old('title') }}">
            @error('title') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Singkat</label>
            <textarea id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            @error('description') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="content">Konten Lengkap</label>
            <textarea id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
            @error('content') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group">
            <label for="image">Gambar Utama</label>
            <div class="image-upload-container">
                <input type="file" id="image" name="image" accept="image/*">
            </div>
             @error('image') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" id="author" name="author" required value="{{ old('author') }}">
        </div>

        <div class="form-group">
            <label for="tags">Kategori Artikel</label>
            <select id="tags" name="tags" class="form-control" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                <option value="">Pilih Kategori</option>
                <option value="Kesehatan Mental" {{ old('tags') == 'Kesehatan Mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                <option value="Kesehatan Reproduksi" {{ old('tags') == 'Kesehatan Reproduksi' ? 'selected' : '' }}>Kesehatan Reproduksi</option>
                <option value="PHBS" {{ old('tags') == 'PHBS' ? 'selected' : '' }}>PHBS</option>
                <option value="Gizi Remaja" {{ old('tags') == 'Gizi Remaja' ? 'selected' : '' }}>Gizi Remaja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="published_at">Tanggal Publikasi</label>
            <input type="date" id="published_at" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}">
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Artikel</button>
        </div>
    </form>
</div>
@endsection
