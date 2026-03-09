<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 *  These routes are examples for redirecting traffic from old CMS pages to the new pages. 
 * You can uncomment them, change the paths, and configure them to match the structure of your old website.
 **/

//  $routes->get('Sections/(:num)_(.+)', function ($id, $slug) {
//     return redirect()->to("/ibc{$id}/{$slug}.html", 301);
// });
 
//  $routes->get('Products/(:num)_(.+).html', function ($id, $slug) {
//     return redirect()->to("/id{$id}/{$slug}.html", 301);
// });

// $routes->get('Pages/(:num)_(.+).html', function ($id, $slug) {
//     return redirect()->to("/pd{$id}/{$slug}.html", 301);
// });

$routes->get('/', 'Home::index');
$routes->match(['GET', 'POST'], '/bd(:num)/(:any).html', 'Brands::details/$1');
$routes->match(['GET', 'POST'], '/id(:num)/(:any).html', 'Items::details/$1');
$routes->match(['GET', 'POST'], '/ibc.html', 'Items::items/ibc/0');
$routes->match(['GET', 'POST'], '/ibc(:num)/(:any).html', 'Items::items/ibc/$1');
$routes->match(['GET', 'POST'], '/newbie.html', 'Items::items/newbie');
$routes->match(['GET', 'POST'], '/sale.html', 'Items::items/sale');
$routes->match(['GET', 'POST'], '/featured.html', 'Items::items/featured');
$routes->match(['GET', 'POST'], '/trending.html', 'Items::items/trending');
$routes->match(['GET', 'POST'], '/search.html', 'Items::items/search');
$routes->match(['GET', 'POST'], '/all.html', 'Items::items/all');
$routes->match(['GET', 'POST'], '/pd(:num)/(:any).html', 'Pages::details/$1');
$routes->match(['GET', 'POST'], '/g(:num)/(:any).html', 'Galleries::gallery/$1');
$routes->match(['GET', 'POST'], '/Blog', 'Blogs::posts');
$routes->match(['GET', 'POST'], '/bpd(:num)/(:any).html', 'Blogs::posts_details/$1');
$routes->match(['GET', 'POST'], '/bpbc(:num)/(:any).html', 'Blogs::posts/bpbc/$1');
$routes->match(['GET', 'POST'], '/bsearch.html', 'Blogs::posts/search');
$routes->get('Users', 'Users::index');
$routes->match(['GET', 'POST'], 'Users', 'Users::index');
$routes->match(['GET', 'POST'], 'Users/(:any)', 'Users::$1');
$routes->get('Backend', 'Backend::index');
$routes->match(['GET', 'POST'], 'Backend/(:any)', 'Backend::$1');
$routes->get('Tools', 'Tools::index');
$routes->match(['GET', 'POST'], 'Tools/captcha_image/(:any)', 'Tools::captcha_image/$1');
$routes->match(['GET', 'POST'], 'Tools/(:any)', 'Tools::$1');
$routes->match(['GET', 'POST'], 'cache/components/(:any)', 'Tools::components/$1');
$routes->match(['GET', 'POST'], 'cache/images/(:any)', 'Tools::images/$1');
$routes->get('Banners', 'Banners::index');
$routes->match(['GET', 'POST'], 'Banners/(:any)', 'Banners::$1');
$routes->get('Galleries', 'Galleries::index');
$routes->match(['GET', 'POST'], 'Galleries/(:any)', 'Galleries::$1');
$routes->get('Categories', 'Categories::index');
$routes->match(['GET', 'POST'], 'Categories/(:any)', 'Categories::$1');
$routes->get('Sections', 'Sections::index');
$routes->match(['GET', 'POST'], 'Sections/(:any)', 'Sections::$1');
$routes->get('Brands', 'Brands::index');
$routes->match(['GET', 'POST'], 'Brands/(:any)', 'Brands::$1');
$routes->get('Blogs', 'Blogs::index');
$routes->match(['GET', 'POST'], 'Blogs/(:any)', 'Blogs::$1');
$routes->get('Awards', 'Awards::index');
$routes->match(['GET', 'POST'], 'Awards/(:any)', 'Awards::$1');
$routes->get('Natives', 'Natives::index');
$routes->match(['GET', 'POST'], 'Natives/(:any)', 'Natives::$1');
$routes->get('Industries', 'Industries::index');
$routes->match(['GET', 'POST'], 'Industries/(:any)', 'Industries::$1');
$routes->get('Places', 'Places::index');
$routes->match(['GET', 'POST'], 'Places/(:any)', 'Places::$1');
$routes->get('Regions', 'Regions::index');
$routes->match(['GET', 'POST'], 'Regions/(:any)', 'Regions::$1');
$routes->get('Voices', 'Voices::index');
$routes->match(['GET', 'POST'], 'Voices/(:any)', 'Voices::$1');
$routes->get('Talents', 'Talents::index');
$routes->match(['GET', 'POST'], 'Talents/(:any)', 'Talents::$1');
$routes->get('Links', 'Links::index');
$routes->match(['GET', 'POST'], 'Links/(:any)', 'Links::$1');
$routes->get('MailsServers', 'MailsServers::index');
$routes->match(['GET', 'POST'], 'MailsServers/(:any)', 'MailsServers::$1');
$routes->get('Ajax', 'Ajax::index');
$routes->match(['GET', 'POST'], 'Ajax/(:segment)/(:any)/(:any)', 'Ajax::$1/$2/$3');
$routes->match(['GET', 'POST'], 'Ajax/(:segment)/(:any)', 'Ajax::$1/$2');
$routes->match(['GET', 'POST'], 'Ajax/(:segment)', 'Ajax::$1');
$routes->get('Items', 'Items::index');
$routes->match(['GET', 'POST'], 'Items/(:any)', 'Items::$1');
$routes->get('Pages', 'Pages::index');
$routes->match(['GET', 'POST'], 'Pages/(:any)', 'Pages::$1');
$routes->get('Feeds', 'Feeds::index');
$routes->match(['GET', 'POST'], 'Feeds/(:any)', 'Feeds::$1');
$routes->get('sitemap.xml', 'Feeds::sitemap');
$routes->get('images.xml', 'Feeds::images');
$routes->get('shop.xml', 'Feeds::shop');
$routes->get('rss.xml', 'Feeds::rss');
$routes->match(['GET', 'POST'], 'Go/(:segment)/(:any)/(:any)', 'Ajax::$1/$2/$3');
$routes->match(['GET', 'POST'], 'Go/(:segment)/(:any)', 'Ajax::$1/$2');
$routes->match(['GET', 'POST'], 'Go/(:segment)', 'Ajax::$1');
$routes->get('Cart', 'Cart::index');
$routes->match(['GET', 'POST'], 'Cart', 'Cart::index');
$routes->get('Checkout', 'Checkout::index');
$routes->match(['GET', 'POST'], 'Checkout', 'Checkout::index');
$routes->get('Thanks', 'Thanks::index');
$routes->get('Contact', 'Contact::index');
$routes->get('Analytics', 'Analytics::index');
$routes->match(['GET', 'POST'], 'Analytics/(:any)', 'Analytics::$1');
$routes->get('Emails', 'Emails::index');
$routes->match(['GET', 'POST'], 'Emails/(:any)', 'Emails::$1');
$routes->get('Configurations', 'Configurations::index');
$routes->match(['GET', 'POST'], 'Configurations', 'Configurations::index');