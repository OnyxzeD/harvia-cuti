<?php

class General_model extends CI_Model
{

    public function getNoUrut($table, $key, $prefix, $where = null, $value = null)
    {
        $this->db->select($key);
        if (!is_null($where)) {
            $this->db->where($where, $value);
        }
        $this->db->order_by($key, 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($table);
        $result = $query->row_array();
        $urut = (int)filter_var($result[$key], FILTER_SANITIZE_NUMBER_INT) + 1;

        if ($urut < 10) {
            return $prefix . "00" . $urut;
        } else if ($urut >= 10 && $urut < 100) {
            return $prefix . "0" . $urut;
        } else {
            return $prefix . "" . $urut;
        }
    }
}
