<?php
$router = new Router();
$categorySlug = @getParams()[1];

$router->get('kategoriler', function () {
    loadView('categories/index', 'Tüm Kategoriler');
});


$router->get("kategori/$categorySlug", function () {
    loadView('categories/details', 'Tüm Kategoriler');
});