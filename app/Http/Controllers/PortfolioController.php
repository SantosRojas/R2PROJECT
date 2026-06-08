<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;

class PortfolioController extends Controller
{
    public function index()
    {
        $categories = Category::active()->ordered()->get();
        $projects = Project::active()->when(request('category'), function ($query, $slug) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $slug));
        })->with('category')->ordered()->paginate(12);

        return view('frontend.portfolio', compact('categories', 'projects'));
    }

    public function show(Project $project)
    {
        if (!$project->is_active) {
            abort(404);
        }

        $project->load('category', 'mediaItems');
        $moreProjects = Project::active()->where('id', '!=', $project->id)->with('category')->ordered()->take(3)->get();

        return view('frontend.portfolio-detail', compact('project', 'moreProjects'));
    }
}
