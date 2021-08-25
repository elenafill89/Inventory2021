<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

$route['default_controller'] = 'Login';
$route['404_override'] = 'controllererror';
$route['translate_uri_dashes'] = FALSE;

/*Fungsi route penamaan untuk HALAMAN LOGIN */
$route['Login']['post'] = 'controllererror';
$route['Login']['get'] = 'Login';

$route['signin']['post'] = 'Login/ceklogin';
$route['signin']['get'] = 'controllererror';

$route['register']['post'] = 'controllererror';
$route['register']['get'] = 'Login/register';

$route['regin']['post'] = 'Login/regin';
$route['regin']['get'] = 'controllererror';

$route['forgot']['post'] = 'controllererror';
$route['forgot']['get'] = 'Login/forgot';

$route['resetpass']['post'] = 'Login/reset';
$route['resetpass']['get'] = 'controllererror';

$route['logout']['post'] = 'controllererror';
$route['logout']['get'] = 'Login/logout';

$route['admin']['post'] = 'Dashboard';
$route['admin']['get'] = 'Dashboard';

/*Fungsi route penamaan untuk halaman utama atau dashboard */
$route['highpriority']['get'] = 'Dashboard/high';
$route['highpriority']['post'] = 'controllererror';

$route['pending']['get'] = 'Dashboard/pending';
$route['pending']['post'] = 'controllererror';

/*Fungsi route penamaan untuk Halaman klien */
$route['client']['get'] = 'Klien';
$route['client']['post'] = 'controllererror';

$route['edit_']['post'] = 'Klien/editdata';
$route['add_']['post'] = 'Klien/simpan';

$route['edit_client']['get'] = 'controllererror';
$route['edit_client']['post'] = 'Edkln0012/get_data';

$route['delete_client']['get'] = 'controllererror';
$route['delete_client']['post'] = 'Klien/hapus';

/*Fungsi route penamaan untuk Proses Halaman Supplier */
$route['supplier']['get'] = 'Moldinginven';
$route['supplier']['post'] = 'controllererror';

$route['addsupplier']['get'] = 'controllererror';
$route['addsupplier']['post'] = 'Moldinginven/addmolding';

$route['editsupplier']['get'] = 'controllererror';
$route['editsupplier']['post'] = 'Moldinginven/editmold';

$route['deletesupplier']['get'] = 'controllererror';
$route['deletesupplier']['post'] = 'Moldinginven/busakmolding';

/*Fungsi route penamaan untuk Proses Halaman Product Release */
$route['item']['get'] = 'Newitem';
$route['item']['post'] = 'controllererror';

$route['daily']['get'] = 'controllererror';
$route['daily']['post'] = 'Newitem/additem';

$route['stok']['get'] = 'controllererror';
$route['stok']['post'] = 'Newitem/stockitem';

$route['change']['get'] = 'controllererror';
$route['change']['post'] = 'Newitem/edititem';

$route['item_del']['get'] = 'controllererror';
$route['item_del']['post'] = 'Newitem/hapus';

$route['details']['get'] = 'controllererror';
$route['details']['post'] = 'Newitem/detailsitem';

/*Fungsi route penamaan untuk Proses Halaman Purchase Order */
$route['tools']['get'] = 'Toolinven';
$route['tools']['post'] = 'controllererror';

$route['ntools']['get'] = 'Toolinven/cancelpo';
$route['ntools']['post'] = 'controllererror';

$route['ctools']['get'] = 'controllererror';
$route['ctools']['post'] = 'Toolinven/canceled';

$route['addtool']['post'] = 'controllererror';
$route['addtool']['get'] = 'Toolinven/adding';

$route['additpo']['get'] = 'Toolinven/addsess';
$route['additpo']['post'] = 'controllererror';

$route['editools']['get'] = 'controllererror';
$route['editools']['post'] = 'Toolinven/editing';

$route['inventool']['get'] = 'controllererror';
$route['inventool']['post'] = 'Toolinven/invent';

$route['detiltool']['get'] = 'controllererror';
$route['detiltool']['post'] = 'Toolinven/inventdetil';

$route['printtool']['get'] = 'controllererror';
$route['printtool']['post'] = 'Toolinven/printdetil';

$route['printpo']['get'] = 'controllererror';
$route['printpo']['post'] = 'Toolinven/printdtl';

$route['receivpo']['get'] = 'Toolinven/receivpo';
$route['receivpo']['post'] = 'controllererror';

$route['tookdtl']['get'] = 'controllererror';
$route['tookdtl']['post'] = 'Toolinven/tookdt';

$route['temptool']['get'] = 'controllererror';
$route['temptool']['post'] = 'Toolinven/broken';

$route['alltool']['get'] = 'controllererror';
$route['alltool']['post'] = 'Toolinven/moveall';

$route['deltool']['get'] = 'controllererror';
$route['deltool']['post'] = 'Toolinven/deleting';

/*Fungsi route penamaan untuk Proses Halaman Pembelian IT */
$route['buy']['get'] = 'Assetmanage';
$route['buy']['post'] = 'controllererror';

$route['addbuy']['get'] = 'Assetmanage/simpanbuy';
$route['addbuy']['post'] = 'controllererror';

$route['addsupp']['get'] = 'Assetmanage/simpansupp';
$route['addsupp']['post'] = 'controllererror';

$route['editbuy']['get'] = 'controllererror';
$route['editbuy']['post'] = 'Assetmanage/edit_buy';

$route['buydelete']['get'] = 'controllererror';
$route['buydelete']['post'] = 'Assetmanage/hapus_buy';
