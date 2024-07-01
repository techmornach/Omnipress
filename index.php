<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// common variables and fucntions 
include_once("om.incs/common.php");
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$id = isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0;

if (!$id) {
    if ($page) {
        $r = Page::getInstanceByName($page);
        $PAGEDATA = $r;
        if ($r && isset($r->id))
            $id = $r->id;
        unset($r);
    } else if (!$id) { // else load by special
        $special = 1;
        if (!$page) {
            $r = Page::getInstanceBySpecial($special);
            $PAGEDATA = $r;
            if ($r && isset($r->id)) $id = $r->id;
            unset($r);
        }
    }
} else if ($id) {
    $PAGEDATA = (isset($r) && $r) ? $r : Page::getInstance($id);
} else {
    echo '404 thing goes here';
    exit;
}

// throw new Exception('page' . $page . 'id:' . $id);

echo $PAGEDATA->body;
