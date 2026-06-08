<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredProjects = Project::active()->featured()->with('category')->ordered()->take(6)->get();
        $testimonials = Testimonial::active()->ordered()->get();

        return view('frontend.home', compact('featuredProjects', 'testimonials'));
    }
}
