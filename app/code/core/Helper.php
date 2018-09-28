<?php

namespace App\Code\Core;
use App\Code\Modules\Login\Models\Login;
class Helper {
    public function view($name, $data = []) {
        extract($data);
        return require "views/{$name}.view.php";
    }

    public function redirect($url) {
        header('Location: ' . $url, true, 302);
        exit;
    }

    public function isAdmin(){
        $position = App::get('database')->select('SELECT role_id FROM users WHERE id="'.Login::isLoggedIn().'"');
        if($position[0]->role_id == "1"){
            return true;
        }
    }

    public function hasRights(){
        $position = App::get('database')->select('SELECT role_id FROM users WHERE id="'.Login::isLoggedIn().'"');
        if($position[0]->role_id == "2"){
            return true;
        }
    }
}