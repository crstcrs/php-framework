<?php

namespace App\Code\Modules\Attendance\Controllers;

use App\Code\Core\App;
use App\Code\Core\Helper;
use App\Code\Modules\Login\Models\Login;

class AttendanceController
{
    public function attendance() {
        $user = App::get('database')->select('SELECT role_id FROM users WHERE id ="'.Login::isLoggedIn().'"');
        if(isset($_POST['var']) && $user[0]->role_id == '1') {
            $id = $_POST['var'];
        }else{
            $id = Login::isLoggedIn();
        }
        $dates = App::get('database')->select('SELECT date FROM attendance WHERE user_id ="'.$id.'" ORDER BY date ASC');
        $vacation = App::get('database')->select('SELECT vacation_date FROM vacation WHERE user_id ="'.$id.'" ORDER BY vacation_date ASC');
        $sortedDates=array();
        $vacationDay=array();
        $thisMonth=array();
        foreach($dates as $date){
            $sortedDates[date("d.m.Y",$date->date)][] = $date->date;
        }
        foreach ($vacation as $vacationD){
            $vacationDay[date("d.m.Y",$vacationD->vacation_date)] = true;
        }
        $hours = array();
        foreach($sortedDates as $today => $newDate) {
            $i = 0;
            foreach($newDate as $oneDate) {
                if(!isset($newDate[$i + 1])) {
                    break;
                }
                if ($i % 2 == 0) {
                    $diff = strtotime(date("Y-m-d H:i:s",$newDate[$i + 1])) - strtotime(date("Y-m-d H:i:s",$oneDate));
                    $hours[$today][] = array(
                        'type' => 1,
                        'value' => $diff
                    );
                } else {
                    $diff = strtotime(date("Y-m-d H:i:s",$newDate[$i + 1])) - strtotime(date("Y-m-d H:i:s",$oneDate));
                    $hours[$today][] = array(
                        'type' => 0,
                        'value' => $diff
                    );
                }
                $i++;
            }
        }
        $list=array();
        if (isset($_POST['month'])){
            $month = $_POST['month'];
        }
        else{
            $month = date ('m');
        }
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, date('Y'));
            if (date('m', $time)== $month)
                $list[]=date('d.m.Y', $time);
        }
        $vac =null;
        $week = null;
            foreach($list as $day):
                foreach ($hours as $d => $h):
                    if(substr($day,3,2) == substr($d,3,2)) {
                            $vac = isset($vacationDay[$day]) ? true : null;
                            $week = $this->isWeekend(date('Y-m-d', strtotime($day))) ? true : null;
                            if ($vac && ($vac == $week)) {
                                $week = null;
                            }
                            if (substr($day, 0, 2) == substr($d, 0, 2)) {
                                $thisMonth[$day] = array(
                                    'worked' => $h,
                                    'vacation' => $vac,
                                    'weekend' => $week
                                );
                            } else {
                                if(!isset($thisMonth[$day])) {
                                    $thisMonth[$day] = array(
                                        'worked' => null,
                                        'vacation' => $vac,
                                        'weekend' => $week
                                    );
                                }
                            }
                    }else{
                        continue;
                    }
                endforeach;
            endforeach;
        return App::get('helper')->view('attendance/attendance', ['bodyClasses' => 'attendance','dates'=>$thisMonth]);
    }
    public function startAt() {
        $id = Login::isLoggedIn();
        App::get('database')->update('INSERT INTO attendance (user_id,date) VALUES ("'.$id.'","'.time().'")');
        Helper::redirect("/attendance");
    }
    protected function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }
}