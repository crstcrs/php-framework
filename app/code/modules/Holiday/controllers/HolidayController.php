<?php

namespace App\Code\Modules\Holiday\Controllers;

use App\Code\Core\App;
use App\Code\Modules\Login\Models\Login;

class HolidayController
{
    public function holiday() {
        $position = App::get('database')->select('SELECT role_id FROM users WHERE id="'.Login::isLoggedIn().'"');
        $employees = App::get('database')->select('SELECT id,firstname,lastname FROM users ');
        return App::get('helper')->view('holiday/holiday', ['bodyClasses' => 'holiday','position'=>$position[0]->role_id,'employees'=>$employees]);
    }
}