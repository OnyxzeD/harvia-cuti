<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bagian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bagian_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('bagian/bagian_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Bagian_model->json();
    }

    public function read($id) 
    {
        $row = $this->Bagian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kd_bagian' => $row->kd_bagian,
		'nm_bagian' => $row->nm_bagian,
	    );
            $this->load->view('bagian/bagian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bagian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bagian/create_action'),
	    'kd_bagian' => set_value('kd_bagian'),
	    'nm_bagian' => set_value('nm_bagian'),
	);
        $this->load->view('bagian/bagian_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nm_bagian' => $this->input->post('nm_bagian',TRUE),
	    );

            $this->Bagian_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bagian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bagian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bagian/update_action'),
		'kd_bagian' => set_value('kd_bagian', $row->kd_bagian),
		'nm_bagian' => set_value('nm_bagian', $row->nm_bagian),
	    );
            $this->load->view('bagian/bagian_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bagian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kd_bagian', TRUE));
        } else {
            $data = array(
		'nm_bagian' => $this->input->post('nm_bagian',TRUE),
	    );

            $this->Bagian_model->update($this->input->post('kd_bagian', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bagian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bagian_model->get_by_id($id);

        if ($row) {
            $this->Bagian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bagian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bagian'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nm_bagian', 'nm bagian', 'trim|required');

	$this->form_validation->set_rules('kd_bagian', 'kd_bagian', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bagian.xls";
        $judul = "bagian";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Bagian");

	foreach ($this->Bagian_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_bagian);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bagian.doc");

        $data = array(
            'bagian_data' => $this->Bagian_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('bagian/bagian_doc',$data);
    }

}

/* End of file Bagian.php */
/* Location: ./application/controllers/Bagian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-28 17:30:23 */
/* http://harviacode.com */