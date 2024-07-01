<?php
session_start();


spl_autoload_register(function ($class) {
    require dirname(__DIR__) .  '/om.php_classes/' . $class . '.php';
});

class Database
{
    private $db;
    public $num_queries = 0;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
        $this->db->query('SET NAMES utf8');
    }

    public function query($sql)
    {
        $this->num_queries++;
        return $this->db->query($sql);
    }

    public function getDb()
    {
        return $this->db;
    }
}

function dbInit()
{
    if (isset($GLOBALS['db'])) return $GLOBALS['db'];
    global $DBVARS;
    $GLOBALS['db'] = new Database($DBVARS['host'], $DBVARS['dbname'], $DBVARS['username'], $DBVARS['password']);
    return $GLOBALS['db'];
}

function dbQuery($query)
{
    $db = dbInit();
    $q = $db->query($query);
    return $q;
}

function dbRow($query)
{
    $q = dbQuery($query);
    return $q->fetch(PDO::FETCH_ASSOC);
}

// define('SCRIPTBASE', $_SERVER['DOCUMENT_ROOT'] . '/');
define('SCRIPTBASE', dirname(__DIR__) . '/');
require SCRIPTBASE . '.private/config.php';
if (!defined('CONFIG_FILE')) {
    define('CONFIG_FILE', SCRIPTBASE . '.private/config.php');
}
set_include_path(SCRIPTBASE . 'om.php_classes' . PATH_SEPARATOR . get_include_path());
