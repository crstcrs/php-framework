<?php

namespace App\Code\Modules\Task\Controllers;

use App\Code\Modules\Task\Models\Task;
use App\Code\Modules\Project\Models\Project;
use App\Code\Core\App;

class TaskController
{
    public function projectsList()
    {
        $projects = Project::getAllProjects();
        return App::get('helper')->view('tasks/projects', array('projects' => $projects));
    }

    public function tasksList($boardId)
    {
        if (empty($boardId) || $boardId == NULL) {
            App::get('helper')->redirect('dashboard');
        }

        $data = Task::getBoardTasks($boardId);

        return App::get('helper')->view('tasks/view', array('data' => $data));
    }
}