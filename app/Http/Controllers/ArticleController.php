<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::orderBy('created_at', 'desc')
            ->when($request->search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(12);
            
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'tags' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('image');
        
        if($request->tags) {
            $data['tags'] = json_encode([$request->tags]);
        }

        if ($request->hasFile('image')) {
             $image = $request->file('image');
             $filename = time() . '.webp';
             $path = 'articles/' . $filename;
             
             $data['image'] = $this->compressAndSaveImage($image, $path);
        }

        $data['uploader'] = auth()->user()->name;

        $article = Article::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'created',
            'subject_type' => 'Article',
            'subject_id' => $article->id,
            'description' => 'Created article: ' . $article->title
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'tags' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('image');

        if($request->tags) {
            $data['tags'] = json_encode([$request->tags]);
        }

        if ($request->hasFile('image')) {
            if ($article->image) {
                $oldPath = str_replace('storage/', '', $article->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $image = $request->file('image');
            $filename = time() . '.webp';
            $path = 'articles/' . $filename;
            
            $data['image'] = $this->compressAndSaveImage($image, $path);
        }

        $article->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'subject_type' => 'Article',
            'subject_id' => $article->id,
            'description' => 'Updated article: ' . $article->title
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            $oldPath = str_replace('storage/', '', $article->image);
            Storage::disk('public')->delete($oldPath);
        }
        
        $title = $article->title;
        $article->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'subject_type' => 'Article',
            'subject_id' => $article->id,
            'description' => 'Deleted article: ' . $title
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus');
    }

    /**
     * Display a listing of articles for public view with pagination.
     */
    /**
     * Display a listing of articles for public view with pagination.
     */
    public function publicIndex(Request $request)
    {
        $articles = Article::orderBy('published_at', 'desc')
            ->when($request->search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(12);
        return view('articles-list', compact('articles'));
    }

    public function landing()
    {
        // 1. Highlight: Most recent article
        $highlight = Article::orderBy('published_at', 'desc')->first();
        
        // 2. Popular: Top 3 by views (excluding highlight if desired, but simplest is just top views)
        // If we want to exclude the highlight from popular, we can add where('id', '!=', $highlight->id)
        $popular = Article::orderBy('views', 'desc')
            ->when($highlight, function($query) use ($highlight) {
                return $query->where('id', '!=', $highlight->id);
            })
            ->take(3)
            ->get();
            
        // 3. Others: 3 articles with lowest views (or just random/latest excluding others)
        // Request said: "urutan artikel yang paling jarang dikunjungi" -> orderBy views asc
        $others = Article::orderBy('views', 'asc')
            ->when($highlight, function($query) use ($highlight) {
                return $query->where('id', '!=', $highlight->id);
            })
            ->whereNotIn('id', $popular->pluck('id'))
            ->take(3)
            ->get();

        return view('articles', compact('highlight', 'popular', 'others'));
    }

    public function show(Article $article)
    {
        $article->increment('views');
        return view('articles.show', compact('article'));
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
