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
            $sortedDates[date("d.m.y",$date->date)][] = $date->date;
        }
        $hours = array();

        foreach($sortedDates as $today => $newDate) {
            $i = 0;
            foreach($newDate as $oneDate) {
                if(!isset($newDate[$i + 1])) {
                    break;
                }
                if ($i % 2 == 0) {
                    //$diff = date_diff(date_create(date("F j, Y, g:i a",$oneDate)), date_create(date("F j, Y, g:i a",$newDate[$i + 1])));
                    $diff = strtotime(date("Y-m-d H:i:s",$newDate[$i + 1])) - strtotime(date("Y-m-d H:i:s",$oneDate));
                    $hours[$today][] = array(
                        'type' => 1,
                        'value' => $diff
                    );
                } else {
//                    $diff = date_diff(date_create(date("F j, Y, g:i a",$oneDate)), date_create(date("F j, Y, g:i a",$newDate[$i + 1])));
                    $diff = strtotime(date("Y-m-d H:i:s",$newDate[$i + 1])) - strtotime(date("Y-m-d H:i:s",$oneDate));
                    $hours[$today][] = array(
                        'type' => 0,
                        'value' => $diff
                    );
                }
                $i++;
            }
        }
        return App::get('helper')->view('attendance/attendance', ['bodyClasses' => 'attendance','dates'=>$hours]);
    }
    public function startAt() {
        $id = Login::isLoggedIn();
        App::get('database')->update('INSERT INTO attendance (user_id,date) VALUES ("'.$id.'","'.time().'")');
        Helper::redirect("/attendance");
    }
}