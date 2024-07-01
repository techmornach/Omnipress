<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__DIR__) . "/om.incs/basics.php";
function isAdmin()
{

    if (!isset($_SESSION["userdata"]))
        return false;
    if (
        isset($_SESSION["userdata"]['$groups']['_superadministrators']) || isset($_SESSION["userdata"]['groups']['_administrators'])
    ) {
        return true;
    } else {
        $_REQUEST['login_msg'] = 'permissiondenied';
        return false;
    }
}

if (!isAdmin()) {
    require SCRIPTBASE . 'om.admin/auth/login.php';
    exit;
} else if (isAdmin()) {
    require SCRIPTBASE . 'om.admin/dashboard/home.php';
    exit();
}
