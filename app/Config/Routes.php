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
     $routes->get("user","admin\Admin::viewEmp");
     $routes->match(['get','post'],"adduser","admin\Admin::adduser");
     $routes->match(['get','post'],"edituser/(:num)","admin\Admin::edituser/$1");
     $routes->match(['get','post'],"deleteuser/(:num)","admin\Admin::deleteuser/$1");
    });

$routes->get('/logout','Login::logout');
$routes->group("user",["filter"=>"auth"],function($routes){
    $routes->get("/","User::index");
 });
 $routes->get('/','User::index');

 
 
