<?php
require(dirname(__DIR__) . "/om.incs/login-libs.php");

login_check_is_email_provided();

$r = dbRow('select email from user_accounts where email="' . addslashes($_REQUEST["email"]) . '" and active');


if (!$r) {
    $url .= '?forgot-password=true';
    login_redirect($url, 'nosuchemail', true);
}
