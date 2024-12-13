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
     $routes->match(['get','post'],"viewuser/(:num)","admin\Admin::viewuser/$1");

     $routes->match(['get','post'],"amenities", "admin\Amenities::index");
      
     $routes->match(['get','post'],"storeamt","admin\Amenities::store_amenities");  
     $routes->match(['get','post'],"amenity_table","admin\Amenities::show");
     $routes->match(['get','post'],"edit_amenity/(:num)","admin\Amenities::edit/$1");
     $routes->match(['get','post'],"delete/(:num)","admin\Amenities::delete/$1");


     $routes->get('category', 'admin\CategoryController::add');
     $routes->match(['get', 'post'], 'addcategory', 'admin\CategoryController::save');
     $routes->match(['get','post'],'categoryview', 'admin\CategoryController::index');
     $routes->match(['get','post'],'categoryedit/(:num)', 'admin\CategoryController::edit/$1');
     $routes->match(['get','post' ],'categoryedit1/(:num)', 'admin\CategoryController::update/$1');
     $routes->match(['get','post' ], 'categorydelete/(:num)', 'admin\CategoryController::delete/$1');
     $routes->match(['get','post'],"deletebrand/(:num)","admin\Brand::deletebrand/$1");
     $routes->match(['get','post'],"brand","admin\Brand::addbrand");
     $routes->match(['get','post'],"brtable","admin\Brand::viewBrand");
     $routes->match(['get','post'],"editbrand/(:num)","admin\Brand::editbrand/$1"); 
     //end brand part
    
     $routes->match(['get', 'post'], "banner", "admin\Banner::index");
    $routes->match(['get', 'post'], "storeban", "admin\Banner::store_banner");  
    $routes->match(['get', 'post'], "banner_table", "admin\Banner::show");
    $routes->match(['get', 'post'], "edit_banner/(:num)", "admin\Banner::edit/$1");
    $routes->match(['get', 'post'], "delete/(:num)", "admin\Banner::delete/$1");
    
    //start product part
    $routes->match(['get','post'],"product","admin\Product::addproduct");
    $routes->match(['get','post'],"prtable","admin\Product::viewProduct");
    $routes->match(['get','post'],"editproduct/(:num)","admin\Product::editProduct/$1");
    $routes->match(['get','post'],"deleteproduct/(:num)","admin\Product::deleteproduct/$1");
    //end product part
    
    $routes->match(['get','post'],"services","admin\Services::addservice");
     $routes->match(['get','post'],"srtable","admin\Services::viewServices");
     $routes->match(['get','post'],"editservices/(:num)","admin\Services::editServices/$1");
     $routes->match(['get','post'],"deleteservices/(:num)","admin\Services::deleteServices/$1");
     //start services part
    
    
     $routes->match(['get','post'],"allbrand","admin\Brand::get_allbrand");
     $routes->match(['get','post'],"allService","admin\Services::get_allService");
     $routes->match(['get', 'post'], "blog_form", "admin\Blog::create");
     $routes->match(['post'], "save_blog", "admin\Blog::save");
     $routes->match(['get','post'],"blog_list", "admin\Blog::index");
     $routes->match(['get', 'post'], 'edit_blog/(:num)', 'admin\Blog::edit/$1'); // GET method to show the edit form, POST method to update the blog
     $routes->match(['post', 'put'], 'update_blog/(:num)', 'admin\Blog::update/$1'); // POST or PUT method to update a blog
     $routes->POST('delete_blog/(:num)', 'admin\Blog::delete/$1'); // GET method to delete a blog
     $routes->match(['get','post'],'add_market','admin\Market::add_market');
     $routes->match(['get','post'],'store_market','admin\Market::store_market');
     $routes->match(['get','post'],'viewtable','admin\Market::viewtable');
     $routes->match(['get','post'],'edit_market/(:num)','admin\Market::edit_market/$1');
     $routes->POST('update_market/(:num)','admin\Market::update_market/$1');
     $routes->POST('delete_market/(:num)','admin\Market::delete_market/$1');


     $routes->match(['get', 'post'], 'enquiry', 'adminadmin\Enquiry::index');

     // Route to submit a new enquiry
     $routes->match(['get', 'post'], 'enquirysubmit', 'admin\Enquiry::submit');
 
     // Route to view all enquiries in a list
     $routes->match(['get', 'post'], 'enquiryview', 'admin\Enquiry::view');
 
     // Route to show details of a specific enquiry
     $routes->match(['get', 'post'], 'enquiryshow/(:num)', 'admin\Enquiry::show/$1');
 
     // Route to update the status of a specific enquiry
     $routes->post('enquiryupdateStatus/(:num)', 'admin\Enquiry::updateStatus/$1');
     $routes->get('enquirydelete/(:num)', 'admin\Enquiry::delete/$1');
    // start community
    $routes->match(['get','post'],"community","admin\Community::viewtable");
$routes->match(['get','post'],"addcommunity","admin\Community::add_cummunity");
$routes->match(['get','post'],"update_community/(:num)","admin\Community::update_communitys/$1");
$routes->match(['get','post'],"deletecommunity/(:num)","admin\Community::deletecummunity/$1");
// SubCommunity
$routes->match(['get','post'],"subcommunity","admin\SubCommunity::view_subcommunity");
$routes->match(['get','post'], 'addsubcommunity', 'admin\SubCommunity::add_subcommunity');
$routes->match(['get','post'],"deletesubcommunity/(:num)","admin\SubCommunity::deletecummunity/$1");
$routes->match(['get','post'],"update_subcommunity/(:num)","admin\SubCommunity::update_viewcommunity/$1");
// UserCommunity
$routes->match(['get','post'],"usercommunity","admin\Ucommu::view_usercommunity");
$routes->match(['get','post'],"usercommunityupdate/(:num)","admin\Ucommu::update_cummnunity/$1");
$routes->match(['get','post'],"cummunitytable","admin\Ucommu::table");
    });
    $routes->group("hki", ["filter" => "auth"], function ($routes) {
        $routes->match(['get','post'],"/", "hki\VendorController::index");
         $routes->match(['get','post'],"user","hki\VendorController::viewEmp");
      //  $routes->match(['get','post'],"edituser/(:num)","hki\hki::edituser/$1");
      //  $routes->match(['get','post'],"adduser","hki\hki::adduser");
      //  $routes->match(['get','post'],"deleteuser/(:num)","hki\hki::deleteuser/$1");
       $routes->match(['get','post'],"update_profile","hki\Profile::update_profile");
       
       
       $routes->match(['get','post'], "deletebrand2/(:num)", "hki\Brand::deletebrand/$1");
       $routes->match(['get', 'post'], 'addBrand2', 'hki\Brand::addbrand');
       $routes->match(['get','post'], "brand2", "hki\Brand::viewBrand");
       $routes->match(['get','post'], "editbrand2/(:num)", "hki\Brand::editbrand/$1");
       
      
       $routes->match(['get','post'],"profile","hki\Profile::profileview");
      //start product part
      $routes->match(['get', 'post'], "product2", "hki\Product::addproduct");
      $routes->match(['get', 'post'], "prtable2", "hki\Product::viewProduct");
      $routes->match(['get', 'post'], "editproduct2/(:num)", "hki\Product::editProduct/$1");
      $routes->match(['get', 'post'], "deleteproduct2/(:num)", "hki\Product::deleteproduct/$1");
      
       //end product part
       //start service part
      $routes->match(['get','post'],"services2","hki\Services::addservice");
       $routes->match(['get','post'],"srtable2","hki\Services::viewServices");
       $routes->match(['get','post'],"editservices2/(:num)","hki\Services::editServices/$1");
       $routes->match(['get','post'],"deleteservices2/(:num)","hki\Services::deleteServices/$1");
       //end service part
       $routes->match(['get','post'],"product3","hki\Product::get_allproduct");
       $routes->match(['get','post'],"allService2","hki\Services::get_allService");
      });

$routes->get('/logout','Login::logout');
$routes->group("user",["filter"=>"auth"],function($routes){
    $routes->get("/","User::index");
 });
 $routes->get('/','User::index');

 
 
