@extends('layouts.admin')

@section('title', 'Manage Projects - Aorta Malang')

@section('content')
<div class="page-header">
    <h1 class="page-title">Proyek</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn-new-item">
        <i class="fas fa-plus"></i> New Project
    </a>
</div>

@if(session('success'))
<div id="successAlert" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; transition: opacity 0.5s ease;">
    {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        var alert = document.getElementById('successAlert');
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500);
        }
    }, 5000);
</script>
@endif

<div class="content-grid">
    @foreach($projects as $project)
    <div class="project-item">
        <div class="item-image">
             @if($project->image)
                <img src="{{ asset($project->image) }}" alt="{{ $project->title }}">
            @else
                <div style="width:100%; height:100%; background:#eee; display:flex; justify-content:center; align-items:center; color:#999;">No Image</div>
            @endif
        </div>
        <div class="item-details">
            <h3 class="item-title">{{ $project->title }}</h3>
             <div class="item-meta">
                <span>Project Manager: {{ $project->project_leader }}</span>
                <span>{{ \Carbon\Carbon::parse($project->start_date)->format('M Y') }}</span>
            </div>
            <p class="item-desc">{{ Str::limit($project->description, 100) }}</p>
            
            <div class="item-actions">
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn-action btn-edit" style="text-decoration:none; text-align:center;">
                    <i class="fas fa-edit"></i> Edit
                </a>
               <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="flex:1;">
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
    {{ $projects->links() }}
</div>
@endsection
