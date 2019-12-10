<?php

class date_time extends CI_Model {

    public function dateformat($date) {
        if (!empty($date)) {
            return date("d/m/Y", strtotime($date));
        } else {
            return '';
        }
    }
    
    public function dbformat($date) {
        if (!empty($date)) {
            list($d,$m,$y) = explode("/", $date);
            return $y."-".$m."-".$d;
        } else {
            return '';
        }
    }

}
