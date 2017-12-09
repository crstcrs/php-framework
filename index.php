<?php
require 'vendor/autoload.php';

require 'app/code/core/bootstrap.php';

use App\Code\Core\Router;
use App\Code\Core\Request;

Router::load('routes.php')
    ->call(Request::uri(), Request::method());