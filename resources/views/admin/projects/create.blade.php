@extends('layouts.admin')

@section('title', 'New Project - Aorta Malang')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Proyek Baru</h1>
    <a href="{{ route('admin.projects.index') }}" class="btn-cancel" style="text-decoration:none; padding:8px 15px; font-size:0.9rem;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="modal-content" style="max-width: 800px; margin: 0; position: static; transform: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Nama Proyek</label>
            <input type="text" id="title" name="title" required value="{{ old('title') }}">
            @error('title') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Proyek</label>
            <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
             @error('description') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group">
            <label for="image">Gambar Proyek</label>
            <div class="image-upload-container">
                <input type="file" id="image" name="image" accept="image/*">
            </div>
             @error('image') <span style="color:red; font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="project_leader">Project Manager</label>
            <input type="text" id="project_leader" name="project_leader" required value="{{ old('project_leader') }}">
        </div>

        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date" required value="{{ old('start_date') }}">
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Proyek</button>
        </div>
    </form>
</div>
@endsection
