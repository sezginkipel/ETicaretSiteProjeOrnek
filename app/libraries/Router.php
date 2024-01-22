<?php
class Router
{
    public static function get($url, $callback)
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            if($url == @$_GET['url'])
            {
                $callback();
            }
        }
    }

    public static function post($url, $callback)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($url == @$_GET['url'])
            {
                $callback();
            }
        }
    }
}