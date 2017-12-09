<?php

namespace App\Code\Modules\Login\Controllers;

use App\Code\Core\App;
use App\Code\Modules\Login\Models\Login;

class IndexController {
    public function login() {
        return App::get('helper')->view('login/index', ['bodyClasses' => 'login']);
    }

    public function loginPost() {
        $email = $_POST['email'];
        $password = hash('sha512', $_POST['password']);

        $results = App::get('database')->select('SELECT * FROM users WHERE email = :email AND password = "'.$password.'" ', array(':email' => $email));

        if(!empty($results)) {
            Login::loginUser($results[0]->id);
            App::get('helper')->redirect('dashboard');
        } else {
            setcookie('login_error', 'Invalid login !');
            App::get('helper')->redirect('/');
        }
    }

    public function logout() {
        if($id = Login::isLoggedIn()) {
            App::get('database')->update('UPDATE users SET log_token = :token WHERE id = :id', array(':token' => '', ':id' => $id));
            setcookie('approved', '-1', time()-3600);
            App::get('helper')->redirect('/');
        }
        else {
            App::get('helper')->redirect('/');
        }
    }
}
