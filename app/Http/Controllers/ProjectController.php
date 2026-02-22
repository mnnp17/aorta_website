<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_leader' => 'required|string|max:255',
            'start_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
             $image = $request->file('image');
             $filename = time() . '.webp';
             $path = 'projects/' . $filename;
             
             $data['image'] = $this->compressAndSaveImage($image, $path);
        }

        $project = Project::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'created',
            'subject_type' => 'Project',
            'subject_id' => $project->id,
            'description' => 'Created project: ' . $project->title
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_leader' => 'required|string|max:255',
            'start_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($project->image) {
                $oldPath = str_replace('storage/', '', $project->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $image = $request->file('image');
            $filename = time() . '.webp';
            $path = 'projects/' . $filename;
            
            $data['image'] = $this->compressAndSaveImage($image, $path);
        }

        $project->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'subject_type' => 'Project',
            'subject_id' => $project->id,
            'description' => 'Updated project: ' . $project->title
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            $oldPath = str_replace('storage/', '', $project->image);
            Storage::disk('public')->delete($oldPath);
        }
        
        $title = $project->title;
        $project->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'subject_type' => 'Project',
            'subject_id' => $project->id,
            'description' => 'Deleted project: ' . $title
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function publicIndex()
    {
        $allProjects = Project::orderBy('created_at', 'desc')->get();
        $featuredProject = $allProjects->first();
        
        // Map for JS
        $mappedProjects = $allProjects->map(function($p) {
            return [
                'id' => $p->id,
                'title' => $p->title,
                'excerpt' => \Illuminate\Support\Str::limit($p->description, 100),
                'image' => $p->image ? asset($p->image) : asset('img/default.jpg'),
                'leader' => $p->project_leader,
                'date' => \Carbon\Carbon::parse($p->start_date)->format('M Y'),
                'url' => route('projects.show', $p),
            ];
        });

        return view('projects', compact('featuredProject', 'mappedProjects'));
    }
    private function compressAndSaveImage($image, $path)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);
        
        // Resize first to reasonable dimensions
        $img->scale(width: 1000);

        // Recursive compression
        $quality = 80;
        $encoded = $img->toWebp($quality);
        
        while (strlen($encoded) > 512000 && $quality > 10) { // 500KB = 512000 bytes
            $quality -= 5;
            $encoded = $img->toWebp($quality);
        }
        
        Storage::disk('public')->put($path, $encoded);
        return 'storage/' . $path;
    }
}
