<?php

function loadView($view, $pageTitle = 'Ecommerce Website')
{
    require "./views/$view.php";
}


function createSlug($string)
{
    $slug = trim($string);
    $slug = strtolower($string);
    $slug = str_replace(['ı', 'ğ', 'ü', 'ş', 'ö', 'ç'], ['i', 'g', 'u', 's', 'o', 'c'], $slug);
    $slug = str_replace(' ', '-', $slug);
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    return $slug;
}

function getParams()
{
    $url = @$_GET['url'];
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    return $url;
}

function removeSpecialChars($post)
{
    return htmlspecialchars(trim($post));
}
