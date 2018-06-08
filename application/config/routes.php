<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'conference';

// Admin Routing
$route['admin/logout'] = "admin/logout/admin";
$route['admin/login'] = "admin/login";

//Normal Routing
$route['(:any)/login'] = "conference/login/$1";
$route['(:any)/registration'] = "conference/registration/$1";

// Track Admin Routing
$route['(:any)/track_admin/dashboard'] = "track_admin/dashboard";
$route['(:any)/track_admin/reviewers'] = "track_admin/reviewers";
$route['(:any)/track_admin/reviewers_add'] = "track_admin/reviewers_add";
$route['(:any)/track_admin/reviewers_edit/(:any)'] = "track_admin/reviewers_edit/$2";
$route['(:any)/track_admin/reviewers_delete/(:any)'] = "track_admin/reviewers_delete/$2";
$route['(:any)/track_admin/papers_list'] = "track_admin/papers_list";
$route['(:any)/track_admin/papers_assignment'] = "track_admin/papers_assignment";
$route['(:any)/track_admin/authors'] = "track_admin/authors";
$route['(:any)/track_admin/TitleList/(:any)'] = "track_admin/TitleList/$2";
$route['(:any)/track_admin/track_admins'] = "track_admin/track_admins";
$route['(:any)/track_admin/logout'] = "track_admin/logout/$1";

// Author Routing
$route['(:any)/author/dashboard'] = "author/dashboard";
$route['(:any)/author/upload_paper'] = "author/upload_paper";
$route['(:any)/author/paper_review'] = "author/paper_review";
$route['(:any)/author/logout'] = "author/logout/$1";
$route['(:any)/author/TitleList/(:any)'] = "author/TitleList/$2";

// Reviewer Routing
$route['(:any)/reviewer/dashboard'] = "reviewer/dashboard";
$route['(:any)/reviewer/paper_list'] = "reviewer/paper_list";
$route['(:any)/reviewer/logout'] = "reviewer/logout/$1";
$route['(:any)/reviewer/submitReview'] = "reviewer/submitReview/";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
