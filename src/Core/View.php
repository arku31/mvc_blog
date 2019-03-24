<?php
namespace App\Core;

class View
{
    public function render($template, $data = [])
    {
        extract($data);
        require ROOT_PATH.'templates/'.$template.'.php';
    }
}