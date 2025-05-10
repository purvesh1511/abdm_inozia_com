<?php

defined('BASEPATH') or exit('No direct script access allowed');


function my_autoloader($class)
{

    if (substr($class, 0, 9) == "MY_Addon_") {
   
       if (file_exists($file = APPPATH . 'core/' . $class . '.php')) {
            include $file;
        }
    }
}
spl_autoload_register('my_autoloader');

$route['default_controller']                 = 'welcome/index';
$route['user/resetpassword/([a-z]+)/(:any)'] = 'site/resetpassword/$1/$2';
$route['admin/resetpassword/(:any)']         = 'site/admin_resetpassword/$1';
$route['admin/unauthorized']                 = 'admin/admin/unauthorized';
$route['404_override'] = 'welcome/show_404';
$route['translate_uri_dashes'] = false;
$route['form/appointment']     = 'welcome/appointment';
$route['page/annual_calendar']     = 'welcome/annual_calendar';

//======= front url rewriting==========
$route['page/(:any)'] = 'welcome/page/$1';
$route['read/(:any)'] = 'welcome/read/$1';
$route['frontend']    = 'welcome';

$route['api/v3/hip/token/on-generate-token'] = 'CallbackController/generate_link_token';
$route['api/v3/link/on_carecontext'] = 'CallbackController/webhook_on_carecontext';
$route['api/v3/hiu/consent/request/notify'] = 'CallbackController/hiu_on_consent_notify';
$route['api/v3/links/context/on-notify'] = 'CallbackController/links_context_on_notify';
