<?php

namespace App\Code\Modules\Task\Models;

use App\Code\Core\App;

class Task
{
    public static function getBoardTasks($boardId)
    {
        $tasks = App::get('database')->select("SELECT * FROM tasks WHERE project_id = :project_id", array('project_id' => $boardId));

        $sortedTasks = array();
        foreach ($tasks as $task) {
            $statuses = self::getStatuses();
            $sortedTasks[$task->status_id][] = $task;
        }

        // return tasks sorted by the status ID
        // so we can draw the kan ban board
        return array('statuses' => $statuses, 'tasks' => $sortedTasks);
    }

    public static function getStatusLabelById($taskStatus)
    {
        $label = App::get('database')->select("SELECT label FROM task_status WHERE id = :status_id", array('status_id' => $taskStatus));
        return $label;
    }

    public static function getStatuses()
    {
        $all = App::get('database')->select("SELECT * FROM task_status");

        $statuses = [];
        foreach ($all as $status) {
            $statuses[$status->id] = $status->label;
        }

        return $statuses;
    }
}