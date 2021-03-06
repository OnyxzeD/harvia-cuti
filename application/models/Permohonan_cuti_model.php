<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permohonan_cuti_model extends CI_Model
{

    public $table = 'permohonan_cuti';
    public $id = 'kd_percuti';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kd_percuti,kd_karyawan,tgl_mulai,tgl_selesai,ket,acc');
        $this->datatables->from('permohonan_cuti');
        //add this line for join
        //$this->datatables->join('table2', 'permohonan_cuti.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('permohonan_cuti/read/$1'),'Read')." | ".anchor(site_url('permohonan_cuti/update/$1'),'Update')." | ".anchor(site_url('permohonan_cuti/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kd_percuti');
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
        $this->db->like('kd_percuti', $q);
	$this->db->or_like('kd_karyawan', $q);
	$this->db->or_like('tgl_mulai', $q);
	$this->db->or_like('tgl_selesai', $q);
	$this->db->or_like('ket', $q);
	$this->db->or_like('acc', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kd_percuti', $q);
	$this->db->or_like('kd_karyawan', $q);
	$this->db->or_like('tgl_mulai', $q);
	$this->db->or_like('tgl_selesai', $q);
	$this->db->or_like('ket', $q);
	$this->db->or_like('acc', $q);
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

/* End of file Permohonan_cuti_model.php */
/* Location: ./application/models/Permohonan_cuti_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-28 17:28:27 */
/* http://harviacode.com */