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
class posting extends Base_model {

    // table name
    protected static $table_name = "posting_record";
    // db connection
    private $conn;
    //db fileds
    protected static $db_fields = array('post_id', 'post_place_id', 'appointment_start_date', 'appointment_end_date', 'file', 'personal_record_id');
    public $pk_id;
    public $post_id;
    public $post_place_id;
    public $appointment_start_date;
    public $appointment_end_date;
    public $file;
    public $personal_record_id;

    // public function __construct() {
    //     $this = new database();
    // }

    /**
     * 
     * find_all
     * @return type
     * 
     * 
     */
    public function find_all() {
       if ($_SESSION['role'] == 1) {
        $strSql = "SELECT * FROM " . static::$table_name;

        return $this->query($strSql);
       } else {
    $strSql = "SELECT * FROM " . static::$table_name;
         return $this->query($strSql);
       }
    }

    public function checklastdate($id) {

        $strSql = "SELECT pk_id FROM " . static::$table_name . " WHERE personal_record_id = $id AND appointment_end_date = '0000-00-00'";
//        echo $strSql;
//        exit;
//        $res = $this->query($strSql);
        $res = mysqli_query($this,$strSql);
        if($res->num_rows > 0){
            return true;
        } else {
            return false;
        }
//        $res = mysqli_query($this,$strSql);
        
        
//       echo $res;
//        exit;
//
//        $flag = false;
//
//        if (!empty($res)) {
//
////            foreach ($res as $key) {
//            while($row = $res->fetch_assoc()){
////                print_r($row);
////                echo '<pre>';
////                exit;
//                if ($row['appointment_end_date'] == '0000-00-00') {
//                    $flag = true;
//                }
//            }
//        }
//        return $flag;
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
        return $this->query($strSql);
    }

    public function find_by_personal($id = 0) {
        //select query
       $strSql = "SELECT DISTINCT
	posting_record.pk_id,
	posts_record.name,
	tbl_warehouse.wh_name,
        posting_record.appointment_start_date,
        posting_record.appointment_end_date,
	posting_record.file
FROM
	posting_record
INNER JOIN posts_record ON posting_record.post_id = posts_record.pk_id
INNER JOIN tbl_warehouse ON posting_record.post_place_id = tbl_warehouse.wh_id
WHERE
	posting_record.personal_record_id = $id";
        
        ///echo $strSql; //exit;
        //query result
        return $this->query($strSql);
    }

    /**
     * 
     * count_all
     * @global type $this
     * @return type
     * 
     * 
     */
    public function count_all() {
        //select query
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        //query result
        $result_set = $this->query($sql);
        $row = $this->fetch_array($result_set);
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
     * @global type $this
     * @return type
     * 
     * 
     */
    protected function sanitized_attributes() {
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $this->escape_value($value);
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
     * @global type $this
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
//
//   echo $sql;
//   exit;

        if ($this->query2($sql)) {
            return $this->insert_id();
        } else {
            return false;
        }
        
    }

    /**
     * update
     * @global type $this
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
        $sql .= " WHERE pk_id=" . $this->escape_value($this->pk_id);

//        ECHO $sql;
//        EXIT;
        return $this->query2($sql);
    }

    /**
     * upload
     * @global type $this
     * @return type
     */
    public function upload() {
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key = 'value', key = 'value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= " file = '" . $this->file . "' WHERE pk_id=" . $this->escape_value($this->pk_id);
        $this->query2($sql);
        return true;
    }

    /**
     * 
     * delete
     * @global type $this
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
        $sql .= " WHERE pk_id=" . $this->escape_value($this->pk_id);
        $sql .= " LIMIT 1";

//        echo $sql;
//        exit;

        return $this->query2($sql);
    }

    public function status() {
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= " status = " . $this->status;
        $sql .= " WHERE pk_id=" . $this->escape_value($this->pk_id);
        return $this->query2($sql);
    }

}
