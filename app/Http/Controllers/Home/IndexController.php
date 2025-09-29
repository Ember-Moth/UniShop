<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->render('index');
    }
}