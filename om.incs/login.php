<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__FILE__) . '/' . 'login-libs.php';

login_check_is_email_provided();

//check for password
if (!isset($_REQUEST['password']) || $_REQUEST['password'] == '') {
    login_redirect($url, 'nopassword');
}

//check for email password combination
$password = md5($_REQUEST['email'] . '|' . $_REQUEST['password']);

$r = dbRow('select * from user_accounts where email="' . addslashes($_REQUEST['email']) . '" and password="' . $password . '" and active');

if (!$r) {
    login_redirect($url, 'loginfailed');
}

$_SESSION['userdata'] = $r;
$groups = json_decode($r['groups']);
$_SESSION['userdata']['groups'] = $groups;

foreach ($groups as $g) {
    $_SESSION['userdata']['$groups'][$g] = true;
}

if ($r['extras'] == '')
    $r['extras'] = [];
if ($r['extras']) {
    $_SESSION['userdata']['extras'] = json_decode($r['extras']);
}
login_redirect($url);
