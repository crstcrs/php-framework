<?php

namespace App\Code\Modules\Attendance\Controllers;

use App\Code\Core\App;
use App\Code\Core\Helper;
use App\Code\Modules\Login\Models\Login;

class AttendanceController
{
    public function attendance() {
        $dates = App::get('database')->select('SELECT date FROM attendance WHERE user_id ="'.Login::isLoggedIn().'" ORDER BY date ASC');
        $sortedDates=array();
        foreach($dates as $date){
            $sortedDates[date("m.d.y",$date->date)][] = $date->date;
        }

        return App::get('helper')->view('attendance/attendance', ['bodyClasses' => 'attendance','dates'=>$sortedDates]);
    }
    public function startAt() {
        $cookie_name = "email";
        if(!isset($_COOKIE[$cookie_name])) {
        } else {
            $id = Login::isLoggedIn();
            App::get('database')->update('INSERT INTO attendance (user_id,date) VALUES ("'.$id.'","'.time().'")');
            Helper::redirect("/attendance");
        }
    }
}