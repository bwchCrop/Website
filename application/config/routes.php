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
$route['default_controller'] = 'home';
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;

#ADMIN
#LOGIN
$route['admin']                        = "admin/home";
$route['admin-log-in']                = "admin/login";
$route['admin-do-login']            = "admin/login/do_login";
$route['admin-log-out']                = "admin/login/do_logout";
$route['admin-log-off']                = "admin/login/do_logoff";
$route['admin-log-off(:any)']        = "admin/login/do_logoff/$1";
$route['admin-forgot-password']        = "admin/login/forgot_password";
$route['admin-confirm-password']    = "admin/login/do_forgot";
$route['admin-send-password/(:any)'] = "admin/login/send_password/$1";

#ACCOUNT
$route['manage-admin']        = "admin/account";
$route['add-account']        = "admin/account/add";
$route['delete-account']    = "admin/account/delete";
$route['view-account']        = "admin/account/view";
$route['edit-account']        = "admin/account/edit";
$route['admin-account']        = "admin/account/myaccount";
$route['change-password']    = "admin/account/change_password";
$route['check-password']    = "admin/account/check_password";
$route['change-info']        = "admin/account/update";

#MENU
$route['group-menu']        = "admin/menu/group_menu";
$route['add-group']            = "admin/menu/add_group";
$route['delete-groupmenu']  = "admin/menu/delete_group";
$route['edit-groupmenu']      = "admin/menu/edit_group";
$route['view-groupmenu']      = "admin/menu/view_group";

$route['menu']                = "admin/menu";
$route['menu/(:any)']        = "admin/menu/index/sorting";
$route['add-menu']            = "admin/menu/add";
$route['delete-menu']        = "admin/menu/delete";
$route['view-menu']            = "admin/menu/view_menu";
$route['edit-menu']            = "admin/menu/edit_menu";
$route['reset-menu']        = "admin/menu/reset_menu";

#CATEGORY
$route['category']            = "admin/category";
$route['add-category']        = "admin/category/add";
$route['view-category']        = "admin/category/view";
$route['edit-category']        = "admin/category/edit";
$route['delete-category']    = "admin/category/delete";

$route['doctorcategory']        = "admin/category/doctorcategory";
$route['add-doctorcategory']    = "admin/category/doctorcategory_add";
$route['view-doctorcategory']    = "admin/category/doctorcategory_view";
$route['edit-doctorcategory']    = "admin/category/doctorcategory_edit";
$route['delete-doctorcategory'] = "admin/category/doctorcategory_delete";

$route['itemcategory']            = "admin/category/itemcategory";
$route['add-itemcategory']        = "admin/category/itemcategory_add";
$route['view-itemcategory']        = "admin/category/itemcategory_view";
$route['edit-itemcategory']        = "admin/category/itemcategory_edit";
$route['delete-itemcategory']    = "admin/category/itemcategory_delete";

$route['groupitemcategory']            = "admin/category/groupitemcategory";
$route['add-groupitemcategory']        = "admin/category/groupitemcategory_add";
$route['view-groupitemcategory']    = "admin/category/groupitemcategory_view";
$route['edit-groupitemcategory']    = "admin/category/groupitemcategory_edit";
$route['delete-groupitemcategory']    = "admin/category/groupitemcategory_delete";

$route['locationcategory']            = "admin/category/locationcategory";
$route['add-locationcategory']        = "admin/category/locationcategory_add";
$route['view-locationcategory']    = "admin/category/locationcategory_view";
$route['edit-locationcategory']    = "admin/category/locationcategory_edit";
$route['delete-locationcategory']    = "admin/category/locationcategory_delete";

#POST
$route['admin-post']        = "admin/post";
$route['add-post']            = "admin/post/add";
$route['view-post']            = "admin/post/view";
$route['edit-post']            = "admin/post/edit";
$route['delete-post']        = "admin/post/delete";
$route['edit-post-(:any)']     = "admin/post/edit/$1";
$route['view-post-(:any)']     = "admin/post/edit/$1/view";

#DOCTOR
$route['admin-doctor']            = "admin/doctor";
$route['add-doctor']            = "admin/doctor/add";
$route['delete-doctor']            = "admin/doctor/delete";
$route['edit-doctor']            = "admin/doctor/edit";
$route['edit-doctor-(:any)']     = "admin/doctor/edit/$1";
$route['view-doctor-(:any)']     = "admin/doctor/edit/$1/view";

// Api Doctor
$route['admin-api-doctor'] = "admin/apidoctor";

#HOSPITAL
$route['admin-hospital']        = "admin/hospital";
$route['add-hospital']            = "admin/hospital/add";
$route['delete-hospital']        = "admin/hospital/delete";
$route['edit-hospital']        = "admin/hospital/edit";
$route['edit-hospital-(:any)'] = "admin/hospital/edit/$1";

#BRAND
$route['admin-brand']        = "admin/brand";
$route['add-brand']            = "admin/brand/add";
$route['view-brand']        = "admin/brand/view";
$route['edit-brand']        = "admin/brand/edit";
$route['delete-brand']        = "admin/brand/delete";
$route['edit-brand-(:any)'] = "admin/brand/edit/$1";

#CALENDAR
$route['admin-calendar']    = "admin/calendar";

#TRANSACTION
$route['admin-transaction']        = "admin/transaction";
$route['view-transaction']        = "admin/transaction/view";
$route['export-transaction']    = "admin/transaction/export";

#FEEDBACK
$route['admin-feedback']    = "admin/feedback";
$route['view-feedback']        = "admin/feedback/view";

#CONTACTUS
$route['admin-contactus']    = "admin/contactus";
$route['view-contactus']    = "admin/contactus/view";

#NEWSLETTER
$route['admin-newsletter']            = "admin/newsletter";
$route['view-newsletter']            = "admin/newsletter/view";
$route['export-newsletter']            = "admin/newsletter/export";
$route['download-newsletter-(:any)'] = "admin/newsletter/download/$1";

#SETTING
$route['general-setting']    = "admin/general";

#USER
$route['manage-user']        = "admin/user";
$route['view-user']            = "admin/user/view";
$route['manage-user-export'] = "admin/user/export";

#PERSONALISE
$route['admin-personalise']        = "admin/personalise";
$route['save-personalise']        = "admin/personalise/save";

#TEMP
$route['admin-tempnavigation-(:any)']    = "admin/tempmenu/navigation/$1";
$route['admin-tempdelete']        = "admin/tempmenu/deleteTemp";

#GALLERY (admin/gallery)
$route['admin-gallery']    =    'admin/gallery';
$route['add-gallery']    =    'admin/gallery/add';
$route['view-gallery']    =    'admin/gallery/view';
$route['delete-gallery']    =    'admin/gallery/delete';
$route['edit-gallery']    =    'admin/gallery/edit';
$route['view-gallery-(:any)']    =    'admin/gallery/view/$1';
$route['delete-gallery-(:any)']    =    'admin/gallery/delete/$1';
$route['edit-gallery-(:any)']    =    'admin/gallery/edit/$1';
$route['admin-gallery-index/(:any)']    =    'admin/gallery/index/$1';
$route['admin-gallery-index_/(:any)']    =    'admin/gallery/index_/$1';

#FILEMANAGER (admin/filemanager)
$route['admin-filemanager']    =    'admin/filemanager';
$route['add-filemanager']    =    'admin/filemanager/add';
$route['view-filemanager']    =    'admin/filemanager/view';
$route['delete-filemanager']    =    'admin/filemanager/delete';
$route['edit-filemanager']    =    'admin/filemanager/edit';
$route['view-filemanager-(:any)']    =    'admin/filemanager/view/$1';
$route['delete-filemanager-(:any)']    =    'admin/filemanager/delete/$1';
$route['edit-filemanager-(:any)']    =    'admin/filemanager/edit/$1';
$route['admin-filemanager-index/(:any)']    =    'admin/filemanager/index/$1';

#CONFIGURATION (admin/configuration)
$route['admin-configuration']    =    'admin/configuration';
$route['add-configuration']    =    'admin/configuration/add';
$route['view-configuration']    =    'admin/configuration/view';
$route['delete-configuration']    =    'admin/configuration/delete';
$route['edit-configuration']    =    'admin/configuration/edit';
$route['view-configuration-(:any)']    =    'admin/configuration/view/$1';
$route['delete-configuration-(:any)']    =    'admin/configuration/delete/$1';
$route['edit-configuration-(:any)']    =    'admin/configuration/edit/$1';

#HIGHLIGHT (admin/highlight)
$route['admin-highlight']    =    'admin/highlight';
$route['add-highlight']        =    'admin/highlight/add';
$route['view-highlight']    =    'admin/highlight/view';
$route['delete-highlight']    =    'admin/highlight/delete';
$route['edit-highlight']    =    'admin/highlight/edit';
$route['view-highlight-(:any)']    =    'admin/highlight/view/$1';
$route['delete-highlight-(:any)']    =    'admin/highlight/delete/$1';
$route['edit-highlight-(:any)']    =    'admin/highlight/edit/$1';

#TIMEPICKER (admin/timepicker)
$route['admin-timepicker']    =    'admin/timepicker';
$route['add-timepicker']    =    'admin/timepicker/add';
$route['view-timepicker']    =    'admin/timepicker/view';
$route['delete-timepicker']    =    'admin/timepicker/delete';
$route['edit-timepicker']    =    'admin/timepicker/edit';
$route['view-timepicker-(:any)']    =    'admin/timepicker/edit/$1/view';
$route['delete-timepicker-(:any)']    =    'admin/timepicker/delete/$1';
$route['edit-timepicker-(:any)']    =    'admin/timepicker/edit/$1';

#PATIENT (admin/patient)
$route['admin-patient']    =    'admin/patient';
$route['add-patient']    =    'admin/patient/add';
$route['view-patient']    =    'admin/patient/view';
$route['delete-patient']    =    'admin/patient/delete';
$route['edit-patient']    =    'admin/patient/edit';
$route['view-patient-(:any)']    =    'admin/patient/edit/$1/view';
$route['delete-patient-(:any)']    =    'admin/patient/delete/$1';
$route['edit-patient-(:any)']    =    'admin/patient/edit/$1';
$route['admin-patient-loadfilter']    =    'admin/patient/load_filterExport';
$route['admin-patient-export']    =    'admin/patient/export';

#API_DOCTOR_SCHEDULER (admin/api_doctor_scheduler)
$route['admin-api_doctor_scheduler']    =    'admin/api_doctor_scheduler';
$route['add-api_doctor_scheduler']    =    'admin/api_doctor_scheduler/add';
$route['view-api_doctor_scheduler']    =    'admin/api_doctor_scheduler/view';
$route['delete-api_doctor_scheduler']    =    'admin/api_doctor_scheduler/delete';
$route['edit-api_doctor_scheduler']    =    'admin/api_doctor_scheduler/edit';
$route['view-api_doctor_scheduler-(:any)']    =    'admin/api_doctor_scheduler/edit/$1/view';
$route['delete-api_doctor_scheduler-(:any)']    =    'admin/api_doctor_scheduler/delete/$1';
$route['edit-api_doctor_scheduler-(:any)']    =    'admin/api_doctor_scheduler/edit/$1';
#============== FRONT ================

#USER
$route['api/(:any)/(:any)']    = "api/index/$1/$2";

#NEWSLETTER
$route['add-newsletter']    = "newsletter/add";

#HOME
$route['user-register']                = "home/register_user";
$route['user-login']                = "home/do_login";
$route['user-logout']                = "home/do_logout";
$route['activation-user-(:any)']    = "home/activation/$1";
$route['forgot-password']            = "home/forgot_password";
$route['confirm-password']            = "home/do_forgot";
$route['send-reset-password-(:any)'] = "home/send_reset_password/$1";
$route['reset-password-(:any)']        = "home/reset_password/$1";
$route['get-schedule']                = "home/get_schedule";

#INSPIRATION
//$route['inspiration/index/9/'] = "inspiration/index/9/1";

#CONTACUS
$route['add-message']        = "contactus/add_contactus";

#DOCTOR
$route['doctor-list']            = "doctor/index/$1/$1/$1/$1/$1";
$route['send-doctor-(:any)']    = "doctor/send/$1";

$route['doctor/detail/(:any)'] = "doctor/show/$1";

$route['services']     = "about/sub/services";
$route['facilities'] = "about/sub/facilities";
$route['center-of-excellence']     = "about/coe";

$route['ugd'] = "about/sub/ugd";

$route['about/load_more']     = "about/load_more";

$route['investor']     = "about/sub/investor";

$route['about/(:any)']         = "about/sub/about/$1";
$route['services/(:any)']     = "about/sub/services/1/slug/$1";
$route['facilities/(:any)'] = "about/sub/services/2/slug/$1";
$route['coe/(:any)']         = "about/sub/coe_detail/16/slug/$1";
$route['newsevent/(:any)']  = "about/sub/detail_newsevent/1/slug/$1";

$route['sub/(:any)']                    = "about/sub/$1";
$route['sub/(:any)/(:any)']         = "about/sub/$1/$2";
$route['sub/(:any)/(:any)/(:any)']     = "about/sub/$1/$2/$3";

$route['loadsub/(:any)']                 = "about/load_sub/$1";
$route['loadsub/(:any)/(:any)']         = "about/load_sub/$1/$2";

$route['location/brawijayaclinickemang']         = "location/sub/detail_location/1";

// removed brawijayaclinicuob location but still
// redirect to brawijayaclinicuob, now changed to home page
$route['location/brawijayaclinicuob']             = "home";

$route['location/brawijayahospitalantasari']     = "location/sub/detail_location/3";
$route['location/brawijayarsiadurentiga']         = "location/sub/detail_location/4";
$route['location/brawijayaclinicbuahbatu']         = "location/sub/detail_location/5";
$route['location/brawijayahospitalbojongsari']     = "location/sub/detail_location/6";
$route['location/brawijayahospitaldepok']         = "location/sub/detail_location/6";
$route['location/brawijayasaharjo']                = "location/sub/detail_location/7";
$route['location/brawijayahospitaltangerang']     = "location/sub/detail_location/8";
$route['microsite/brawijayasaharjo']            = "location/sub_static/1";
$route['microsite/brawijayahospitaltangerang']    = "location/sub_static/2";

$route['location/(:any)']                 = "location/index/$1";
$route['location/detail/(:any)']          = "location/sub/detail_location/$1";
$route['location/detail/(:any)/(:any)'] = "location/sub/detail_location/$1/$2";
$route['load_post']                     = "location/load_post";

$route['doctor-schedule']           = "home/advanced_search";
$route['doctor-schedule-(:any)'] = "home/advanced_search/$1";
$route['doctor-schedule/(:any)'] = "home/advanced_search/slug/$1";
$route['schedule/(:any)/(:any)'] = "home/scheduleRs/$1/$2";

$route['search-schedule']     = "search/index";

$route['result/(:any)']     = "home/create_url_search/$1";
$route['appointment']     = "home/create_url_search/$1";
$route['search']               = "home";
$route['reg-success']         = "home";
$route['success']               = "home";
$route['success/(:any)']    = "home/index/$1";
$route['failed']               = "home";
$route['failed/(:any)']     = "home/index/$1";
$route['bandung']               = "home";

$route['career']            = "about/sub/career/1/763";


#Privacy
$route['privacy-policy/moms-diary'] = "/privacy";

#Run Save Api;
// $key = Y1OSFjTKcJ requied parameter
// add the key to url segment :any on browser
// eg: bwh.test/data/loadapi/Y1OSFjTKcJ
$route['data/loadapi/(:any)'] = "load/run/$1";
$route['data/loadapi2/(:any)'] = "load/run_2/$1";
// $route['data/token/test'] = "test/index";

$route['find-doctor'] = "home/find_doctor";

// Landing Page Routes
$route['patient-confirmation/attendance'] = "appointment/attendance";
$route['patient-confirmation/display-attendances'] = "appointment/display_all";
$route['patient-confirmation/detail/(:any)'] = "appointment/show/$1";
$route['patient-confirmation/(:any)'] = "appointment/index/$1";

$route['middleware-appointment/login'] = "appointment/show_login";
$route['middleware-appointment/do_login'] = "appointment/authenticate";

if (ENVIRONMENT != 'production') {
    $route['test-wa'] = "remote/testwa";
}
