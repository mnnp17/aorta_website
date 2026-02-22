<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Project;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = ActivityLog::with('user')->latest()->take(3)->get();
        $totalArticles = Article::count();
        $totalProjects = Project::count();

        return view('admin.dashboard', compact('activities', 'totalArticles', 'totalProjects'));
    }
}
