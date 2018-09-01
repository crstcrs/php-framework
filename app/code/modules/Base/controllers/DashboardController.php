<?php

namespace App\Code\Modules\Base\Controllers;

use App\Code\Core\App;
use App\Code\Modules\Login\Models\Login;

class DashboardController
{
    public function dashboard() {
        $position = App::get('database')->select('SELECT position FROM users WHERE id="'.Login::isLoggedIn().'"');
        $employees = App::get('database')->select('SELECT id,firstname,lastname FROM users ');
        return App::get('helper')->view('dashboard/index', ['bodyClasses' => 'dashboard','position'=>$position[0]->position,'employees'=>$employees]);
    }
}