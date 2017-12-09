<?php

use App\Code\Core\App;
use App\Code\Core\Helper;

App::set('config', require 'config.php');

App::set('helper', new Helper());
App::set('code_url', App::get('config')['code_url'] );

App::set('database', new QueryBuilder(
    Connection::make(
        App::get('config')['database']
    )
));