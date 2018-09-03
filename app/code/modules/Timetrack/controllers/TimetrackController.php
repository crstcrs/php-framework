<?php

namespace App\Code\Modules\Timetrack\Controllers;

use App\Code\Core\App;

class TimetrackController
{
    public function timetrack() {
        $tasks = App::get('database')->select('SELECT * FROM tasks ORDER BY id ASC');
        return App::get('helper')->view('timetrack/timetrack', ['bodyClasses' => 'timetrack','tasks'=>$tasks]);
    }
}