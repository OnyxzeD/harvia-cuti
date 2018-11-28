<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permohonan_cuti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Permohonan_cuti_model', 'General_model'));
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('permohonan_cuti/permohonan_cuti_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Permohonan_cuti_model->json();
    }

    public function read($id)
    {
        $row = $this->Permohonan_cuti_model->get_by_id($id);
        if ($row) {
            $data = array(
                'kd_percuti'  => $row->kd_percuti,
                'kd_karyawan' => $row->kd_karyawan,
                'tgl_mulai'   => $row->tgl_mulai,
                'tgl_selesai' => $row->tgl_selesai,
                'ket'         => $row->ket,
                'acc'         => $row->acc,
            );
            $this->load->view('permohonan_cuti/permohonan_cuti_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan_cuti'));
        }
    }

    public function create()
    {
        $data = array(
            'button'      => 'Create',
            'action'      => site_url('permohonan_cuti/create_action'),
            'kd_percuti'  => set_value('kd_percuti'),
            'kd_karyawan' => set_value('kd_karyawan'),
            'tgl_mulai'   => set_value('tgl_mulai'),
            'tgl_selesai' => set_value('tgl_selesai'),
            'ket'         => set_value('ket'),
            'acc'         => set_value('acc'),
        );
        $this->load->view('permohonan_cuti/permohonan_cuti_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $kd_percuti = $this->General_model->getNoUrut('permohonan_cuti', 'kd_percuti', 'PR');
            $data = array(
                'kd_percuti'  => $kd_percuti,
                'kd_karyawan' => $this->input->post('kd_karyawan', TRUE),
                'tgl_mulai'   => $this->input->post('tgl_mulai', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),
                'ket'         => $this->input->post('ket', TRUE),
                'acc'         => $this->input->post('acc', TRUE),
            );

            $this->Permohonan_cuti_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('permohonan_cuti'));
        }
    }

    public function update($id)
    {
        $row = $this->Permohonan_cuti_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'      => 'Update',
                'action'      => site_url('permohonan_cuti/update_action'),
                'kd_percuti'  => set_value('kd_percuti', $row->kd_percuti),
                'kd_karyawan' => set_value('kd_karyawan', $row->kd_karyawan),
                'tgl_mulai'   => set_value('tgl_mulai', $row->tgl_mulai),
                'tgl_selesai' => set_value('tgl_selesai', $row->tgl_selesai),
                'ket'         => set_value('ket', $row->ket),
                'acc'         => set_value('acc', $row->acc),
            );
            $this->load->view('permohonan_cuti/permohonan_cuti_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan_cuti'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kd_percuti', TRUE));
        } else {
            $data = array(
                'kd_karyawan' => $this->input->post('kd_karyawan', TRUE),
                'tgl_mulai'   => $this->input->post('tgl_mulai', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),
                'ket'         => $this->input->post('ket', TRUE),
                'acc'         => $this->input->post('acc', TRUE),
            );

            $this->Permohonan_cuti_model->update($this->input->post('kd_percuti', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permohonan_cuti'));
        }
    }

    public function delete($id)
    {
        $row = $this->Permohonan_cuti_model->get_by_id($id);

        if ($row) {
            $this->Permohonan_cuti_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('permohonan_cuti'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan_cuti'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kd_karyawan', 'kd karyawan', 'trim|required');
        $this->form_validation->set_rules('tgl_mulai', 'tgl mulai', 'trim|required');
        $this->form_validation->set_rules('tgl_selesai', 'tgl selesai', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');
        $this->form_validation->set_rules('acc', 'acc', 'trim|required');

        $this->form_validation->set_rules('kd_percuti', 'kd_percuti', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "permohonan_cuti.xls";
        $judul = "permohonan_cuti";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kd Karyawan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Selesai");
        xlsWriteLabel($tablehead, $kolomhead++, "Ket");
        xlsWriteLabel($tablehead, $kolomhead++, "Acc");

        foreach ($this->Permohonan_cuti_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kd_karyawan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_mulai);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_selesai);
            xlsWriteLabel($tablebody, $kolombody++, $data->ket);
            xlsWriteLabel($tablebody, $kolombody++, $data->acc);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=permohonan_cuti.doc");

        $data = array(
            'permohonan_cuti_data' => $this->Permohonan_cuti_model->get_all(),
            'start'                => 0
        );

        $this->load->view('permohonan_cuti/permohonan_cuti_doc', $data);
    }

}

/* End of file Permohonan_cuti.php */
/* Location: ./application/controllers/Permohonan_cuti.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-28 17:28:27 */
/* http://harviacode.com */