<?php

require_once 'database.php';

/**
 * clsStockMaster
 * @package classes
 * 
 * @author     Ajmal Hussain
 * @email <ahussain@ghsc-psm.org>
 * 
 * @version    2.2
 * 
 */
// If it's going to need the database, then it's
// probably smart to require it before we start.
class warehouse {

    // table name
    protected static $table_name = "tbl_warehouse";
    // db connection
    private $conn;
    //db fileds
    protected static $db_fields = array('wh_id', 'wh_name', 'dist_id', 'stkid', 'prov_id', 'locid');
    public $wh_id;
    public $wh_name;
    public $dist_id;
    public $stkid;
    public $prov_id;
    public $locid;

    public function __construct() {
        $this->conn = new database();
    }

    /**
     * 
     * find_all
     * @return type
     * 
     * 
     */
    public function find_all() {
        if ($_SESSION['role'] == 1) {
            return $this->conn->query("SELECT * FROM " . static::$table_name);
        } else {
            return $this->conn->query("SELECT * FROM " . static::$table_name . " WHERE status=1");
        }
    }

    /**
     * 
     * find_by_id
     * @param type $id
     * @return type
     * 
     * 
     */
    public function find_by_id($id = 0) {
        //select query
        $strSql = "SELECT * FROM " . static::$table_name . " WHERE pk_id={$id} LIMIT 1";
        //query result
        return $this->conn->query($strSql);
    }

    public function districtdropdown() {

//	 $sql =  "SELECT * FROM". locations. " WHERE parent_id = 3;
        $sql = "SELECT * FROM `locations` WHERE parent_id = 3 AND lvl='District' ORDER BY location_name";

        return $this->conn->query($sql);
    }

    public function districtdropdown2() {

        $sql = "SELECT * FROM `tbl_locations` WHERE ParentID = 3";

        return $this->conn->query($sql);
    }

    public function postingplacedropdown() {
        $role = $_SESSION['role'];
        if ($role == 1) {
            $wr_dist = '';
        } else {
            $district_id = $_SESSION['district_id'];
            $wr_dist = "AND tbl_warehouse.dist_id = $district_id";
        }
//        $sql = "SELECT * FROM `tbl_warehouse` WHERE parent_id = 3 AND lvl='Posting Place' ORDER BY location_name";


        $sql = "SELECT
	tbl_warehouse.wh_id,
	CONCAT(
		tbl_locations.LocName,
		', ',
		tbl_warehouse.wh_name
	) wh_name
FROM
	tbl_warehouse
        INNER JOIN stakeholder ON stakeholder.stkid = tbl_warehouse.stkofficeid
        INNER JOIN tbl_locations ON tbl_warehouse.dist_id = tbl_locations.PkLocID
WHERE
stakeholder.lvl = 7
$wr_dist
AND tbl_warehouse.prov_id = 3 GROUP BY tbl_warehouse.wh_name ORDER BY tbl_locations.LocName ASC,
	tbl_warehouse.wh_name ASC";

        return $this->conn->query($sql);
    }

//   $_SESSION['district_id'] = $data['district_of_domicile'];
    /**
     * 
     * count_all
     * @global type $this->conn
     * @return type
     * 
     * 
     */
    public function count_all() {
        //select query
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        //query result
        $result_set = $this->conn->query($sql);
        $row = $this->conn->fetch_array($result_set);
        return array_shift($row);
    }

    /**
     * 
     * instantiate
     * @param type $record
     * @return \self
     * 
     * 
     */
    private function instantiate($record) {
        // Could check that $record exists and is an array
        $object = new self;
        // Simple, long - form approach:
        // More dynamic, short - form approach:
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    /**
     * 
     * has_attribute
     * @param type $attribute
     * @return type
     * 
     * 
     */
    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->attributes());
    }

    /**
     * 
     * attributes
     * @return type
     * 
     * 
     */
    protected function attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    /**
     * 
     * sanitized_attributes
     * @global type $this->conn
     * @return type
     * 
     * 
     */
    protected function sanitized_attributes() {
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $this->conn->escape_value($value);
        }
        return $clean_attributes;
    }

    /**
     * 
     * save
     * @return type
     * 
     * 
     */
    public function save() {
        // A new record won't have an id yet.
        return isset($this->pk_id) ? $this->update() : $this->create();
    }

    /**
     * create
     * @global type $this->conn
     * @return boolean
     */
    public function create() {
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();

        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        echo $sql;
        if ($this->conn->query2($sql)) {
            return $this->conn->insert_id();
        } else {
            return false;
        }
    }

    /**
     * update
     * @global type $this->conn
     * @return type
     */
    public function update() {
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key = 'value', key = 'value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE pk_id=" . $this->conn->escape_value($this->pk_id);
        $this->conn->query2($sql);
        return true;
    }

    /**
     * upload
     * @global type $this->conn
     * @return type
     */
    public function upload() {
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key = 'value', key = 'value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= " file = '" . $this->file . "' WHERE pk_id=" . $this->conn->escape_value($this->pk_id);
        $this->conn->query2($sql);
        return true;
    }

    /**
     * 
     * delete
     * @global type $this->conn
     * @return type
     * 
     * 
     */
    public function delete() {
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        //delete query
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE pk_id=" . $this->conn->escape_value($this->pk_id);
        $sql .= " LIMIT 1";
        return $this->conn->query2($sql);
    }

    public function status() {
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= " status = " . $this->status;
        $sql .= " WHERE pk_id=" . $this->conn->escape_value($this->pk_id);
        return $this->conn->query2($sql);
    }

}
