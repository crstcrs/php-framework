<?php

namespace App\Code\Modules\Base\Controllers;

use App\Code\Core\App;
use App\Code\Modules\Login\Models\Login;

class DashboardController
{
    public function dashboard() {
        return App::get('helper')->view('dashboard/index', ['bodyClasses' => 'dashboard']);
    }
}