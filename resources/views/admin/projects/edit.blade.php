@extends('layouts.admin')

@section('title', 'Edit Project - Aorta Malang')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Proyek</h1>
    <a href="{{ route('admin.projects.index') }}" class="btn-cancel" style="text-decoration:none; padding:8px 15px; font-size:0.9rem;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="modal-content" style="max-width: 800px; margin: 0; position: static; transform: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Nama Proyek</label>
            <input type="text" id="title" name="title" required value="{{ old('title', $project->title) }}">
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Proyek</label>
            <textarea id="description" name="description" rows="5" required>{{ old('description', $project->description) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Gambar Proyek</label>
             @if($project->image)
                <div style="margin-bottom:10px;">
                    <img src="{{ asset($project->image) }}" style="max-height:150px; border-radius:8px;">
                </div>
            @endif
            <div class="image-upload-container">
                <input type="file" id="image" name="image" accept="image/*">
            </div>
             <small style="color:#777;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="form-group">
            <label for="project_leader">Project Manager</label>
            <input type="text" id="project_leader" name="project_leader" required value="{{ old('project_leader', $project->project_leader) }}">
        </div>

        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date" required value="{{ old('start_date', $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') : '') }}">
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Update Proyek</button>
        </div>
    </form>
</div>
@endsection
