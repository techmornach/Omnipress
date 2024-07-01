<?php
class Page
{
    static $instances = array();
    static $instancesByName = array();
    static $instancesBySpecial = array();

    public $id;
    public $type;
    public $special;
    public $name;
    public $urlname;
    public $dbVals;
    public $vars;

    // Declaring all properties used in the class to avoid dynamic property creation
    public $body;
    public $parent;
    public $ord;
    public $cdate;
    public $edate;
    public $title;
    public $template;
    public $keywords;
    public $description;
    public $assiociated_date;

    function __construct($v, $byField = 0, $fromRow = 0, $pvq = 0)
    {
        // byField: 0 = ID, 1 = name, 2 = special
        if (!$byField && is_numeric($v)) {
            $r = $fromRow ? $fromRow : ($v ? dbRow("SELECT * FROM pages WHERE id=$v LIMIT 1") : array());
        } else if ($byField == 1) {
            $name = strtolower(str_replace('-', '_', $v));
            $fname = 'page_by_name_' . md5($name);
            $r = dbRow("SELECT * FROM pages WHERE name='$name' LIMIT 1");
        } else if ($byField == 3 && is_numeric($v)) {
            $fname = 'page_by_special_' . ($v);
            $r = dbRow("SELECT * FROM pages WHERE special=$v LIMIT 1");
        } else {
            throw new InvalidArgumentException("Invalid arguments provided.");
        }

        if (!is_array($r) || !count($r)) {
            // Handle no results found gracefully
            $this->id = 0;
            $this->type = 0;
            $this->special = 0;
            $this->name = 'NO NAME SUPPLIED';
            $this->urlname = '';
            $this->dbVals = array();
            $this->vars = json_decode('{}');
            return;
        }

        if (!isset($r['id'])) {
            $r['id'] = 0;
        }
        if (!isset($r['type'])) {
            $r['type'] = 0;
        }
        if (!isset($r['special'])) {
            $r['special'] = 0;
        }
        if (!isset($r['name'])) {
            $r['name'] = 'NO NAME SUPPLIED';
        }

        foreach ($r as $k => $v) {
            $this->{$k} = $v;
        }

        $this->urlname = $r['name']; // Corrected the assignment of urlname
        $this->dbVals = $r;

        self::$instances[$this->id] = &$this;
        self::$instancesByName[preg_replace('/[^a-z0-9]/', '-', strtolower($this->urlname))] = &$this;
        self::$instancesBySpecial[$this->special] = &$this;

        if (!$this->vars) {
            $this->vars = '{}';
        }
        $this->vars = json_decode($this->vars);
    }

    public static function getInstance($id = 0, $fromRow = false, $pvq = false)
    {
        if (!is_numeric($id)) {
            return false;
        }
        if (!@array_key_exists($id, self::$instances)) {
            self::$instances[$id] = new Page($id, 0, $fromRow, $pvq);
        }
        return self::$instances[$id];
    }

    public static function getInstanceByName($name = '')
    {
        $name = strtolower($name);
        $nameIndex = preg_replace('#[^a-z0-9/]#', '-', $name);
        if (@array_key_exists($nameIndex, self::$instancesByName)) {
            return self::$instancesByName[$nameIndex];
        }
        self::$instancesByName[$nameIndex] = new Page($name, 1);
        return self::$instancesByName[$nameIndex];
    }

    public static function getInstanceBySpecial($sp = 0)
    {
        if (!is_numeric($sp)) {
            return false;
        }
        if (!@array_key_exists($sp, self::$instancesBySpecial)) {
            self::$instancesBySpecial[$sp] = new Page($sp, 3);
        }
        return self::$instancesBySpecial[$sp];
    }
}
