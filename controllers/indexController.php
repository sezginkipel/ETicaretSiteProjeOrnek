<?php

$router = new Router();

$router->get('', function () {
   loadView('index/index', 'Anasayfa');
});

$router->get('hakkimizda', function () {
    loadView('index/about', 'Hakkımızda');
});

$router->get('iletisim', function () {
    loadView('index/contact', 'İletişim');
});