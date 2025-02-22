<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/web/auth.php';
require __DIR__.'/web/panel.php';
require __DIR__.'/web/user.php';

Route::get('/', function () {
    return view('welcome');
});
