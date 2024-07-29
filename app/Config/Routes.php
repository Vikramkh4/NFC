<?php
namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(404);
$routes->setAutoRoute(true);

$routes->get("/signup", "Login::registration_page");
$routes->post("/regischaking", "Login::saving_registration");
$routes->post("/signin", "Login::index");

$routes->group("admin", ["filter" => "auth"], function ($routes) {
    // start admin part
     $routes->get("/", "admin\Admin::index");
    });