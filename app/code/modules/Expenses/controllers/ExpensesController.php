<?php

namespace App\Code\Modules\Expenses\Controllers;

use App\Code\Core\App;

class ExpensesController{
    public function expenses() {
        $month = $this->getMonth();
        $taxes = $this->getTaxes();
        $processedTaxes = array();
        foreach ($taxes as $tax) {
            $name = App::get('database')->select('SELECT firstname,lastname FROM users WHERE id = '.$tax->user_id);
            $processedTaxes[]=array(
                'id' => $tax->id,
                'name' => "".$name[0]->lastname." ".$name[0]->firstname,
                'tax1' => $tax->tax1,
                'tax2' => $tax->tax2,
                'paid' => $tax->paid ? true : false
            );
        }
        return App::get('helper')->view('expenses/expenses', ['bodyClasses' => 'expenses','taxes' => $processedTaxes,'thisMonth' => $month]);
    }
    public function pay(){
        $taxes = $this->getTaxes();
        foreach ($taxes as $tax){
            App::get('database')->update('UPDATE expenses SET paid = 0 WHERE id="'.$tax->id.'"');
        }
    if(!empty($_POST['check_list'])) {
        foreach ($_POST['check_list'] as $check => $paid) {
                App::get('database')->update('UPDATE expenses SET paid = "'.$paid.'" WHERE id="'.$check.'"');
        }
    }
        $this->expenses();
    }
    public function expensesAdd() {
        $employee = $this->getEmployees();
        if(isset($_POST['user_id'])){
            for ($i=0;$i<sizeof($_POST['user_id']);$i++){
                App::get('database')->update('INSERT INTO expenses (user_id,month,tax1,tax2,paid) VALUES ("'.$_POST['user_id'][$i].'","'.$_POST['month'][$i].'","'.$_POST['CAM'][$i].'","'.$_POST['CAS'][$i].'",0)');
            }
        }
        return App::get('helper')->view('expenses/expensesAdd', ['bodyClasses' => 'expensesAdd','employee' => $employee]);
    }
    protected function getTaxes(){
        $month = $this->getMonth();
        $taxes = App::get('database')->select('SELECT id,user_id,tax1,tax2,paid FROM expenses WHERE month="'.$month.'"');
        return $taxes;
    }
    protected  function getMonth(){
        $month = isset($_POST['month']) ? $_POST['month'] : date ('m');
        return $month;
    }
    protected function getEmployees(){
        $employee = App::get('database')->select('SELECT lastname,firstname,id FROM users ');
        $employees = array();
        foreach ($employee as $item){
            $employees[] = array(
                'name' => $item->lastname.' '.$item->firstname,
                'id' => $item->id
            );
        }
        return $employees;
    }
}