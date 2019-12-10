<?php
class category extends Base_model {

    // table name
    protected static $table_name = "category_record";
    // db connection
    private $conn;
    //db fileds
    protected static $db_fields = array('category_value', 'login_id','is_active');
   
public $pk_id;
public $category_value;
public $is_active;




    /**
     * 
     * find_all
     * @return type
     * 
     * 
     */
    public function find_all() {
        if ($_SESSION['role'] == 1) {
//           return $this->query("SELECT * FROM " . static::$table_name);
               $strSql = "SELECT * FROM " . static::$table_name. " where is_active = 1 ORDER BY category_value" ;
               
              
        //query result
        return $this->query($strSql);
            
           
        } else {
//            return $this->query("SELECT * FROM " . static::$table_name );
              $strSql = "SELECT * FROM " . static::$table_name ;
              
              
        //query result
        return $this->query($strSql);
            
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
        return $this->query($strSql);
    }
    
        public function categorydropdown(){
    
	 $sql =  "SELECT * FROM `category_record` WHERE is_active = 1 ORDER BY category_value";
         
         return $this->query($sql);	
     }

    
  public function selectdata4($children_id=null){
   
      
        $strSql = "SELECT * FROM " . static::$table_name ;
        
	if(!empty($children_id)){
            
            $strSql .= " WHERE pk_id = $children_id ";
          
        }
      
	      return $this->query($strSql);
}

    public function find_by_family($id = 0) 
     {
        //select query
   $strSql = "SELECT DISTINCT
	childrens_record.pk_id,
	childrens_record.name,
	childrens_record.date_of_birth,
	childrens_record.school_name
        FROM
	childrens_record
        INNER JOIN family_record ON childrens_record.family_record_id = family_record.pk_id
        WHERE
	childrens_record.family_record_id = $id";
        //query result
        return $this->query($strSql);
    }
    /**
     * 
     * find_by_id
     * @param type $id
     * @return type
     * 
     * 
     */
    public function find_by_department($id = 0) {
        //select query
        $strSql = "SELECT * FROM " . static::$table_name . " WHERE department_id={$id}";
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
        $this->query2($sql);
        return true;
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
        $sql .= " picture = '".$this->picture."' WHERE pk_id=" . $this->escape_value($this->pk_id);
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
        
//        echo  $sql;
//        exit;
        $sql .= " LIMIT 1";
        return $this->query2($sql);
    }

    public function is_active() {
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= " is_active = " . $this->is_active;
        $sql .= " WHERE pk_id=" . $this->escape_value($this->pk_id);
        return $this->query2($sql);
    }

}
