<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shift extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Shift_model', 'General_model'));
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('shift/shift_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Shift_model->json();
    }

    public function read($id)
    {
        $row = $this->Shift_model->get_by_id($id);
        if ($row) {
            $data = array(
                'kd_shift' => $row->kd_shift,
                'shift'    => $row->shift,
                'jam'      => $row->jam,
            );
            $this->load->view('shift/shift_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shift'));
        }
    }

    public function create()
    {
        $data = array(
            'button'   => 'Create',
            'action'   => site_url('shift/create_action'),
            'kd_shift' => set_value('kd_shift'),
            'shift'    => set_value('shift'),
            'jam'      => set_value('jam'),
        );
        $this->load->view('shift/shift_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $kode_shift = $this->General_model->getNoUrut('shift', 'kd_shift', 'S');
            $data = array(
                'kd_shift' => $kode_shift,
                'shift'    => $this->input->post('shift', TRUE),
                'jam'      => $this->input->post('jam', TRUE),
            );

            $this->Shift_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('shift'));
        }
    }

    public function update($id)
    {
        $row = $this->Shift_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'   => 'Update',
                'action'   => site_url('shift/update_action'),
                'kd_shift' => set_value('kd_shift', $row->kd_shift),
                'shift'    => set_value('shift', $row->shift),
                'jam'      => set_value('jam', $row->jam),
            );
            $this->load->view('shift/shift_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shift'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kd_shift', TRUE));
        } else {
            $data = array(
                'shift' => $this->input->post('shift', TRUE),
                'jam'   => $this->input->post('jam', TRUE),
            );

            $this->Shift_model->update($this->input->post('kd_shift', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('shift'));
        }
    }

    public function delete($id)
    {
        $row = $this->Shift_model->get_by_id($id);

        if ($row) {
            $this->Shift_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('shift'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shift'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('shift', 'shift', 'trim|required');
        $this->form_validation->set_rules('jam', 'jam', 'trim|required');

        $this->form_validation->set_rules('kd_shift', 'kd_shift', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "shift.xls";
        $judul = "shift";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Shift");
        xlsWriteLabel($tablehead, $kolomhead++, "Jam");

        foreach ($this->Shift_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->shift);
            xlsWriteLabel($tablebody, $kolombody++, $data->jam);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=shift.doc");

        $data = array(
            'shift_data' => $this->Shift_model->get_all(),
            'start'      => 0
        );

        $this->load->view('shift/shift_doc', $data);
    }

}

/* End of file Shift.php */
/* Location: ./application/controllers/Shift.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-28 17:10:21 */
/* http://harviacode.com */