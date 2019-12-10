<?php

class Base_model extends CI_Model {

    public $last_query;
    private $magic_quotes_active;
    private $real_escape_string_exists;

    public function query($sql) {
        $this->last_query = $sql;
        $result = $this->db->query($sql);
        if (!$result) {
            //error msg
            $output = "Database query failed: " . $this->db->error . "<br /><br />";
            die($output);
        }

        if ($result->num_rows() > 0) {
            $this->db->close();
            return $result;
        } else {
            $this->db->close();
            return '';
        }
    }

    public function query2($sql) {
        if ($this->isRoleAllow($sql)) {
            $this->last_query = $sql;
            $result = $this->db->query($sql);
            if (!$result) {
//error msg
                $output = "Database query failed: " . $this->db->error . "<br /><br />";
                die($output);
            }
            if ($this->db->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isRoleAllow($sql) {

        $session = $this->session->get_userdata();
        $role = $session['role'];
        $command = substr($sql, 0, 6);

        $qry = "SELECT
	role_actions.pk_id
FROM
	role_actions
WHERE
	role_actions.role_id = $role
AND role_actions.action = '$command'
AND role_actions.allow = TRUE";
        $res = $this->db->query($qry);
        if ($res->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function insert_id() {
        return $this->db->insert_id;
    }

    public function escape_value($value) {
        if ($this->real_escape_string_exists) { // PHP v4.3.0 or higher
// undo any magic quote effects so mysql_real_escape_string can do the work
            if ($this->magic_quotes_active) {
                $value = stripslashes($value);
            }
            $value = mysql_real_escape_string($value);
        } else { // before PHP v4.3.0
// if magic quotes aren't already on then add slashes manually
            if (!$this->magic_quotes_active) {
                $value = addslashes($value);
            }
// if magic quotes are active, then the slashes already exist
        }
        return $value;
    }

}
