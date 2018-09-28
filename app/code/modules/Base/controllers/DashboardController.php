<?php

namespace App\Code\Modules\Base\Controllers;

use App\Code\Core\App;

class DashboardController
{
    public function dashboard() {
        $position = App::get('helper')->isAdmin();
        $employees = App::get('database')->select('SELECT id,firstname,lastname FROM users ');
        return App::get('helper')->view('dashboard/index', ['bodyClasses' => 'dashboard','position'=>$position,'employees'=>$employees]);
    }
}