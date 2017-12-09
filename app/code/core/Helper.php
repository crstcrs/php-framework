<?php

namespace App\Code\Core;

class Helper {
    public function view($name, $data = []) {
        extract($data);
        return require "views/{$name}.view.php";
    }

    public function redirect($url) {
        header('Location: ' . $url, true, 302);
        exit;
    }
}