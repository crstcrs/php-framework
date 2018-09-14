<?php

namespace App\Code\Modules\Vacation\Controllers;

use App\Code\Core\App;
use App\Code\Core\Helper;
use App\Code\Modules\Login\Models\Login;

class VacationController
{
    public function vacation() {
        $position = App::get('database')->select('SELECT role_id FROM users WHERE id="'.Login::isLoggedIn().'"');
        if(isset($_POST['vacation_date']) && isset($_POST['user_id']) && $position[0]->role_id == '1') {
            App::get('database')->update('INSERT INTO vacation (user_id,vacation_date) VALUES ("'.$_POST['user_id'].'","'.strtotime($_POST['vacation_date']).'")');
            Helper::redirect("/dashboard");
        }
    }
}