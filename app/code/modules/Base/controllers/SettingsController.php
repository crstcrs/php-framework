<?php

namespace App\Code\Modules\Base\Controllers;

use App\Code\Core\App;
use App\Code\Modules\Task\Models\Task;

class SettingsController {
    public function settings() {

        $statuses = Task::getStatuses();

        return App::get('helper')->view('settings/settings', array('statuses' => $statuses));
    }
}