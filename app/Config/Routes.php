<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('auth', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/callback', 'Auth::callback');
$routes->get('auth/forbidden', 'Auth::forbidden');

$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('monitor', 'Monitor::index');

$routes->get('dashboard', 'Dashboard::index',['filter' => 'auth']);

$routes->group("ajax", ["filter" => "auth"], function ($routes) {
    $routes->get('searchunor', 'Ajax::searchunor');
    $routes->get('searchpendidikan', 'Ajax::searchpendidikan');
    // $routes->post('add', 'Users::add');
});

$routes->group("cpns", ["filter" => "auth"], function ($routes) {
    $routes->get('', 'Cpns::index');
    $routes->get('rincian/(:any)', 'Cpns::rincian/$1');
    $routes->get('getjenis/(:any)', 'Cpns::getjenis/$1');
    $routes->get('getjabatan/(:any)/(:any)', 'Cpns::getjabatan/$1/$2');
    $routes->post('getpendidikan', 'Cpns::getpendidikan');
    $routes->post('getdata', 'Cpns::getdata');
    $routes->get('getterisi', 'Cpns::getterisi');
    $routes->post('add', 'Cpns::add');
    $routes->get('delete/(:any)', 'Cpns::delete/$1');
    $routes->get('rekap', 'Cpns::rekap');
    $routes->get('export', 'Cpns::export');
    $routes->get('final', 'Cpns::final');
});
