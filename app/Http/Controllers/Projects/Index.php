<?php

namespace App\Http\Controllers\Projects;

use App\Models\Project;
use Illuminate\Contracts\View\View;

class Index
{
    public function __invoke(): View
    {
        $projects = Project::query()
            ->latest()
            ->get();

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }
}
