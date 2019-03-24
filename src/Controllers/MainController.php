<?php
namespace App\Controllers;

use App\Core\Request;

class MainController
{
    public function index(Request $request)
    {
        echo '<pre>';
        print_r($request);
        die();
    }
}