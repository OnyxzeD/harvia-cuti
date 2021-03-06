<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bagian_model extends CI_Model
{

    public $table = 'bagian';
    public $id = 'kd_bagian';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kd_bagian,nm_bagian');
        $this->datatables->from('bagian');
        //add this line for join
        //$this->datatables->join('table2', 'bagian.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('bagian/read/$1'),'Read')." | ".anchor(site_url('bagian/update/$1'),'Update')." | ".anchor(site_url('bagian/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kd_bagian');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kd_bagian', $q);
	$this->db->or_like('nm_bagian', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kd_bagian', $q);
	$this->db->or_like('nm_bagian', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Bagian_model.php */
/* Location: ./application/models/Bagian_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-28 17:30:23 */
/* http://harviacode.com */