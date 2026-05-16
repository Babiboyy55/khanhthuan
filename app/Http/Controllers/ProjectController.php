<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->where('status', 'published')
            ->orderByDesc('year')
            ->orderByDesc('created_at')
            ->get();

        return view('projects', [
            'projects' => $projects,
        ]);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        
        // Lấy các dự án khác để hiển thị ở sidebar hoặc phần liên quan
        $relatedProjects = Project::where('id', '!=', $id)
            ->where('status', 'published')
            ->limit(5)
            ->get();

        return view('project-detail', [
            'project' => $project,
            'relatedProjects' => $relatedProjects
        ]);
    }
}
