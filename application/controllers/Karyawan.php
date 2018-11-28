<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Karyawan_model', 'General_model'));
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('karyawan/karyawan_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Karyawan_model->json();
    }

    public function read($id)
    {
        $row = $this->Karyawan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'kd_karyawan' => $row->kd_karyawan,
                'nm_karyawan' => $row->nm_karyawan,
                'jk'          => $row->jk,
                'alamat'      => $row->alamat,
                'telepon'     => $row->telepon,
                'status'      => $row->status,
                'jumlah_anak' => $row->jumlah_anak,
            );
            $this->load->view('karyawan/karyawan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function create()
    {
        $data = array(
            'button'      => 'Create',
            'action'      => site_url('karyawan/create_action'),
            'kd_karyawan' => set_value('kd_karyawan'),
            'nm_karyawan' => set_value('nm_karyawan'),
            'jk'          => set_value('jk'),
            'alamat'      => set_value('alamat'),
            'telepon'     => set_value('telepon'),
            'status'      => set_value('status'),
            'jumlah_anak' => set_value('jumlah_anak'),
        );
        $this->load->view('karyawan/karyawan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $kode_karyawan = $this->General_model->getNoUrut('karyawan', 'kd_karyawan', 'K');
            $data = array(
                'kd_karyawan' => $kode_karyawan,
                'nm_karyawan' => $this->input->post('nm_karyawan', TRUE),
                'jk'          => $this->input->post('jk', TRUE),
                'alamat'      => $this->input->post('alamat', TRUE),
                'telepon'     => $this->input->post('telepon', TRUE),
                'status'      => $this->input->post('status', TRUE),
                'jumlah_anak' => $this->input->post('jumlah_anak', TRUE),
            );

            $this->Karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function update($id)
    {
        $row = $this->Karyawan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'      => 'Update',
                'action'      => site_url('karyawan/update_action'),
                'kd_karyawan' => set_value('kd_karyawan', $row->kd_karyawan),
                'nm_karyawan' => set_value('nm_karyawan', $row->nm_karyawan),
                'jk'          => set_value('jk', $row->jk),
                'alamat'      => set_value('alamat', $row->alamat),
                'telepon'     => set_value('telepon', $row->telepon),
                'status'      => set_value('status', $row->status),
                'jumlah_anak' => set_value('jumlah_anak', $row->jumlah_anak),
            );
            $this->load->view('karyawan/karyawan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kd_karyawan', TRUE));
        } else {
            $data = array(
                'nm_karyawan' => $this->input->post('nm_karyawan', TRUE),
                'jk'          => $this->input->post('jk', TRUE),
                'alamat'      => $this->input->post('alamat', TRUE),
                'telepon'     => $this->input->post('telepon', TRUE),
                'status'      => $this->input->post('status', TRUE),
                'jumlah_anak' => $this->input->post('jumlah_anak', TRUE),
            );

            $this->Karyawan_model->update($this->input->post('kd_karyawan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Karyawan_model->get_by_id($id);

        if ($row) {
            $this->Karyawan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nm_karyawan', 'nm karyawan', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('jumlah_anak', 'jumlah anak', 'trim|required');

        $this->form_validation->set_rules('kd_karyawan', 'kd_karyawan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "karyawan.xls";
        $judul = "karyawan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nm Karyawan");
        xlsWriteLabel($tablehead, $kolomhead++, "Jk");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Telepon");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Anak");

        foreach ($this->Karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nm_karyawan);
            xlsWriteLabel($tablebody, $kolombody++, $data->jk);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, $data->telepon);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_anak);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=karyawan.doc");

        $data = array(
            'karyawan_data' => $this->Karyawan_model->get_all(),
            'start'         => 0
        );

        $this->load->view('karyawan/karyawan_doc', $data);
    }

}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-28 17:15:52 */
/* http://harviacode.com */