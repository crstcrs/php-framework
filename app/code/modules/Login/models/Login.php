<?php

namespace App\Code\Modules\Login\Models;

use App\Code\Core\App;

class Login {
    public static function loginUser($id) {
        $token = random_bytes(128);
        App::get('database')->update("UPDATE users SET log_token = :token WHERE id= :id", array(":token" => $token, ":id" => intval($id)));
        setcookie('approved', $id . ':' . $token);
    }

    public static function isLoggedIn() {
        $cookie = isset($_COOKIE['approved']) ? $_COOKIE['approved'] : '';
        if(isset($cookie)) {

            list ($id, $token) = explode(':', $cookie);

            $results = App::get('database')->select('SELECT log_token FROM users WHERE id = :id AND log_token = :token', array(':token' => $token, ':id' => $id));
            if(!empty($results)) {
                return $id;
            }
            else {
                return false;
            }
        }
    }
}