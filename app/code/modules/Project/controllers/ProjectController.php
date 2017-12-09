<?php

namespace App\Code\Modules\Project\Controllers;

use App\Code\Modules\Project\Models\Project;
use App\Code\Core\App;

class ProjectController {
    public function projectsList() {
        $projects = Project::getAllProjects();

        return App::get('helper')->view('projects/list', array('projects' => $projects));
    }
}