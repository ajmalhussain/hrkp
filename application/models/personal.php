<?php


class personal extends Base_model {

    // table name
    protected static $table_name = "personal_record";
    // db connection
    private $conn;
    //db fileds
    protected static $db_fields = array('name', 'father_name', 'gender', 'cnic', 'district_of_domicile','date_of_birth', 'contact_no', 'email', 'postal_address', 'pmdc_registration', 'marital_status', 'health_professional','status_two', 'residential_address', 'current_address', 'residential_city', 'current_city', 'created_by', 'employee_number', 'seniority_number', 'cadre_value', 'ddo_number', 'ddo_description', 'husband_name');
    public $pk_id;
    public $name;
    public $father_name;
    public $gender;
    public $cnic;
    public $district_of_domicile;
    public $date_of_birth;
    public $contact_no;
    public $email;
    public $postal_address;
    public $pmdc_registration;
    public $marital_status;
    public $health_professional;
    public $status_two;
    public $residential_address;
    public $current_address;
    public $residential_city;
    public $current_city;
    public $status;
    public $created_by;
    public $employee_number;
    public $seniority_number;
    public $cadre_value;
    public $ddo_number;
    public $ddo_description;
    public $husband_name;

    

    public function total_records() {
        $strsql = "SELECT DISTINCT pk_id FROM " . static::$table_name . " ORDER BY name";
        return $this->query($strsql);
    }

    /**
     * 
     * find_all
     * @return type
     * 
     * 
     */
    public function find_all() {
        $wherestr = '';
        if (isset($this->pk_id)) {
            $wherestr[] = "pk_id=" . $this->pk_id;
        }
        if (isset($this->name)) {
            $wherestr[] = "name = '$this->name'";
        }
        if (isset($this->father_name)) {
            $wherestr[] = "father_name = '$this->father_name'";
        }

        if (isset($this->gender)) {
            $wherestr[] = "gender = '$this->gender'";
        }
        if (isset($this->cnic)) {
            $wherestr[] = "cnic = '$this->cnic'";
        }
        if (isset($this->district_of_domicile)) {
            $wherestr[] = "district_of_domicile = '$this->district_of_domicile'";
        }

        if (isset($this->marital_status)) {
            $wherestr[] = "marital_status = '$this->marital_status'";
        }

        if (is_array($wherestr)) {
            $wherestr = " WHERE " . implode(" AND ", $wherestr);
        }

        return $this->query("SELECT * FROM " . static::$table_name . " $wherestr ");
    }

    /**
     * 
     * find_all
     * @return type
     * 
     * 
     */
    public function export_all($wherestr = '', $limit = '') {
//        if(!empty($limit)) {$limit = ' limit '.$limit;}
//        else{
        $qry = "SELECT
            personal_record.pk_id,
        personal_record.`name`,
    personal_record.father_name,
    personal_record.gender,
    personal_record.cnic,
        tbl_locations.LocName district_dom_name,
    personal_record.district_of_domicile,
    personal_record.date_of_birth,
    personal_record.contact_no,
    personal_record.email,
    personal_record.postal_address,
    personal_record.pmdc_registration,
    personal_record.marital_status,
    personal_record.health_professional,
    personal_record.residential_address,
    personal_record.current_address,
    personal_record.residential_city,
    personal_record.current_city,
        personal_record.status,
    GROUP_CONCAT(
        specialities_record.specility
    ) AS specialities,
    GROUP_CONCAT(trainings_record.title) AS trainings_title,
    GROUP_CONCAT(
        trainings_record.training_date
    ) AS training_date,
    family_record.health_professional AS is_spouse_health_preofessional,
    GROUP_CONCAT(childrens_record.`name`) AS childrens,
    GROUP_CONCAT(
        childrens_record.date_of_birth
    ) AS childrens_dob,
    GROUP_CONCAT(
        childrens_record.school_name
    ) AS childrens_school,
    spouse.`name` AS spouse_name,
    spouse.father_name AS spouse_father_name,
    spouse.gender AS spouse_gender,
    spouse.cnic AS spouse_cnic,
    spouse.district_of_domicile AS spouse_district_of_domicile,
    spouse.date_of_birth AS spouse_date_of_birth,
    spouse.contact_no AS spouse_contact_no,
    spouse.email AS spouse_email,
    spouse.postal_address AS spouse_postal_address,
    spouse.pmdc_registration AS spouse_pmdc_registration,
    spouse.marital_status AS spouse_marital_status,
    spouse.health_professional AS spouse_health_professional,
    spouse.residential_address AS spouse_residential_address,
    spouse.current_address AS spouse_current_address,
    spouse.residential_city AS spouse_residential_city,
    spouse.current_city AS spouse_current_city,
        tbl_locations.LocName district_dom_name,
        posts_record.designation,
        posts_record.bps,
        postplace.wh_name place_of_posting
FROM
    personal_record
LEFT JOIN personal_specialities ON personal_record.pk_id = personal_specialities.personal_record_id
LEFT JOIN specialities_record ON personal_specialities.specility_id = specialities_record.pk_id
LEFT JOIN personal_trainings ON personal_record.pk_id = personal_trainings.personal_record_id
LEFT JOIN trainings_record ON personal_trainings.training_id = trainings_record.pk_id
LEFT JOIN family_record ON personal_record.pk_id = family_record.personal_record_id
LEFT JOIN childrens_record ON family_record.pk_id = childrens_record.family_record_id
LEFT JOIN personal_record spouse ON family_record.spouse_id = spouse.pk_id 
LEFT JOIN posting_record ON personal_record.pk_id = posting_record.personal_record_id
LEFT JOIN tbl_warehouse postplace ON postplace.wh_id = posting_record.post_place_id
LEFT JOIN posts_record ON posting_record.post_id = posts_record.pk_id
LEFT JOIN educational_record ON personal_record.pk_id = educational_record.personal_record_id
LEFT JOIN tbl_locations ON personal_record.district_of_domicile = tbl_locations.PkLocID
                $wherestr GROUP BY personal_record.pk_id $limit";
        //echo $qry;

        return $this->query($qry);
//        }
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

    public function selectdata($personal_id = null) {


        $strSql = "SELECT * FROM " . static::$table_name;

        if (!empty($personal_id)) {

            $strSql .= " WHERE pk_id = $personal_id ";
        }

        return $this->query($strSql);
    }

    public function spousedropdown() {

        $sql = "SELECT * FROM `personal_record` WHERE gender = 'Female' ";

        return $this->query($sql);
    }

    public function find_by_personal($id = 0) {
        //select query
        $strSql = "SELECT DISTINCT
        personal_record.pk_id,
        personal_record.name,
        personal_record.father_name,
        personal_record.gender,
        personal_record.cnic,
        personal_record.district_of_domicile,
        personal_record.marital_status
        FROM
        family_record
        INNER JOIN personal_record ON family_record.spouse_id = personal_record.pk_id
        WHERE
        family_record.personal_record_id = $id";
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

//         echo $sql;
//         exit;

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
        $sql .= " picture = '" . $this->picture . "' WHERE pk_id=" . $this->escape_value($this->pk_id);
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
        return $this->query2($sql);
    }

    public function status() {
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= " status = " . $this->status;
        $sql .= " WHERE pk_id=" . $this->escape_value($this->pk_id);
        return $this->query2($sql);
    }
    
    /**
     * 
     * find_by_id
     * @param type $id
     * @return type
     * 
     * 
     */
    public function find_by_cnic($nic = '') {
        //select query
        $strSql = "SELECT * FROM " . static::$table_name . " WHERE cnic='{$nic}'";
        //query result
        return $this->query($strSql);
    }
  public function find_by_empnumber($emp = '') {
        //select query
        $strSql = "SELECT * FROM " . static::$table_name . " WHERE employee_number='{$emp}'";
        //query result
        return $this->query($strSql);
    }
}
