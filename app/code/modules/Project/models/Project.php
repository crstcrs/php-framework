<?php

namespace App\Code\Modules\Project\Models;

use App\Code\Core\App;

class Project {
    public static function getAllProjects() {
        $projects = App::get('database')->select("SELECT * FROM projects");

        return $projects;
    }
}