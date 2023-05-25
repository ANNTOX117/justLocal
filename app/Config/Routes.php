<?php

namespace Config;
use Config\Services;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

// $routes->group('admin', ['filter' => 'AuthCheck'], static function ($routes) {
$routes->group('admin', ['filter' => 'Role:admin,company'], static function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('companies', 'admin\CompaniesController::index');
    $routes->get('get_company/(:num)', 'admin\CompaniesController::getCompany/$1');
    $routes->get('offers', 'admin\OffersController::index');
    $routes->post('company/create','admin\CompaniesController::add');
    $routes->get('categories', 'admin\CategoriesController::index');
    $routes->post('category/create','admin\CategoriesController::add');
    $routes->get('category/(:num)','admin\CategoriesController::getCategory/$1');
    $routes->get('settings','admin\SettingsController::index');
    $routes->get('home','admin\SettingsController::home');
    $routes->get('users','admin\SettingsController::users');
    $routes->get('sendEmail','admin\SettingsController::sendEmail');
});


$request = Services::request();
$lang = $request->getLocale();
$routes->get('/','SiteController::index');
$routes->get('login','LoginController::index');
$routes->post('logUser','LoginController::logUser');
$routes->get('logged','LoginController::logged');
$routes->get('logout','LoginController::logout');
$routes->get('register','RegisterController::index');
$routes->get('contact','SiteController::contact');
$routes->get('change_password/(:any)','SiteController::change_password/$1');
$routes->post('newsletter-register', 'SiteController::insert_user_newsletter');
$routes->group('ajax', static function ($routes) {
    $routes->post('settings', 'ajax\SettingsController::insertCarousel');
    $routes->post('insert_popular_offer', 'ajax\SettingsController::insert_popular_offer');
    $routes->get('carousel/(:num)', 'ajax\SettingsController::getDataCarouselById/$1');
    $routes->get('offers_by_company/(:num)', 'ajax\SettingsController::get_offers_by_company/$1');
    $routes->get('delete/offer/(:num)', 'ajax\SettingsController::delete_offer/$1');
    $routes->get('delete_offer/(:num)', 'ajax\SettingsController::offer_delete/$1');
    $routes->get('get/offer/(:num)', 'ajax\SettingsController::get_offer/$1');
    $routes->get('delete/how_work/(:num)', 'ajax\SettingsController::delete_howWork/$1');
    $routes->get('popular_offer/(:num)', 'ajax\SettingsController::popular_offer/$1');
    $routes->delete('delete_user/(:num)', 'ajax\SettingsController::delete_user/$1');
    $routes->post('insert_how_it_works', 'ajax\SettingsController::insert_how_it_works');
    $routes->post('insert_carousel_head', 'ajax\SettingsController::insert_carousel_head');
    $routes->post('validate_user', 'ajax\LoginController::validate_user');
    $routes->post('insert_user', 'ajax\LoginController::insert_user');
    $routes->get('provinces_by_country/(:num)', 'ajax\SettingsController::provinces_by_country/$1');
    $routes->get('cities_by_provinces/(:num)/(:num)', 'ajax\SettingsController::cities_by_provinces/$1/$2');
    $routes->get('cities_by_provinceId/(:num)', 'ajax\SettingsController::cities_by_provinceId/$1');
    $routes->get('branches_by_city/(:num)/(:num)', 'ajax\SettingsController::branches_by_city/$1/$2');
    $routes->post('insert_offer', 'ajax\SettingsController::insert_offer');
    $routes->post('insert_review', 'ajax\SettingsController::insert_review');
    $routes->post('insert_multiple_image', 'ajax\SettingsController::insert_multiple_image');
    $routes->post('insert_contact_message', 'ajax\SettingsController::insert_contact_message');
    $routes->post('like_offer_or_company', 'ajax\SettingsController::like_offer_or_company');
    $routes->get('get_liked_offers_by_ip/(:any)', 'ajax\SettingsController::get_liked_offers_by_ip/$1');
    $routes->get('return_pagination_company', 'ajax\SettingsController::return_pagination_company');
    $routes->get('return_pagination_offer', 'ajax\SettingsController::return_pagination_offer');
    $routes->get('get_info_user/(:any)', 'ajax\SettingsController::get_info_user/$1');
    $routes->post('update_user_info/(:any)','ajax\SettingsController::update_user_info/$1');
});

if ($lang == "nl") {
    $routes->get('over_ons','SiteController::about_us',["as" => "about_us"]);
    //$routes->get('bedrijven', 'SiteController::searching_companies',["as" => "bussiness"]);
    $routes->match(['get', 'post'], 'bedrijven', 'SiteController::searching_companies', ["as" => "bussiness"]);

    $routes->get('bedrijven/(:any)', 'SiteController::company/$1',["as" => "bussine"]);
    $routes->get('aanbiedingen', 'SiteController::offers',["as" => "offers"]);
    $routes->get('aanbiedingen/(:any)', 'SiteController::offer/$1',["as" => "offer"]);
    $routes->get('provincies','SiteController::provinces',["as"=>"provinces"]);
    $routes->get('favoriete','SiteController::favorite',["as"=>"favorite"]);
}else{
    $routes->get('about_us','SiteController::about_us',["as"=>"about_us"]);
    //$routes->get('bussiness', 'SiteController::searching_companies',["as" => "bussiness"]);
    $routes->match(['get', 'post'], 'bussiness', 'SiteController::searching_companies', ["as" => "bussiness"]);
    $routes->get('bussiness/(:any)', 'SiteController::company/$1',["as" => "bussine"]);
    $routes->get('offers', 'SiteController::offers',["as" => "offers"]);
    $routes->get('offers/(:any)', 'SiteController::offer/$1',["as" => "offer"]);
    $routes->get('provinces','SiteController::provinces',["as"=>"provinces"]);
    $routes->get('favorite','SiteController::favorite',["as"=>"favorite"]);
}
$routes->get('(:segment)/(:segment)','SiteController::companies_by_cities/$1/$2',["as"=>"province_city"]);
$routes->get('(:any)?','SiteController::provinces/$1',["as"=>"province"]);


//$routes->get('(:any)', 'SiteController::company/$1');
    
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


// $routes->group('company', static function ($routes) {
//     $routes->get('/', 'company\CompanyController::index');
//     $routes->get('edit/(:any)', 'company\CompanyController::edit/$1');
// });




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
