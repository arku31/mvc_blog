<?php
namespace App\Core;

class Response
{
    /**
     * @return false|string
     */
    public function json($data)
    {
        //setheader
        echo json_encode($data);
    }

    /**
     * @param $template
     * @param array $data
     */
    public function view($template, $data = [])
    {
        (new View())->render($template, $data);
    }

    /**
     * @param string $string
     */
    public function redirect(string $string)
    {
        header('Location: '. $this->getSiteUrl() .$string);
        exit;
    }

    /**
     * @return string
     */
    public function getSiteUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'].'/';
        return $protocol.$domainName;
    }
}