<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->checklogin();
        $this->load->model('Sipekeba', 'spkb');
    }

    public function checklogin()
    {
        $sesi_login = $this->session->logged_in;
        if ($sesi_login != true) {
            redirect('login', 'refresh');
        }
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return;
        } else {
            if ($this->uri->segment(2) == FALSE) {
                return;
            } else {
                echo json_encode(["message" => "You dont have permission to this page"]);
                exit;
            }
        }
    }

    public function index()
    {
        $this->load->view('main');
    }

    public function dashboard()
    {
        $this->load->view('dashboard');
    }

    public function data_admin()
    {
        $data['list'] = $this->spkb->get_user_list();
        $this->load->view('data_admin', $data);
    }

    public function tambah_admin()
    {
        $this->load->view('tambah_admin');
    }

    public function tambah_data_admin()
    {
        $input = (object) $this->input->post();
        $this->spkb->tambah_data_admin($input);
    }

    public function data_layanan()
    {
        $data['list'] = $this->spkb->get_layanan_list();
        $this->load->view('data_layanan', $data);
    }

    public function tambah_layanan()
    {
        $this->load->view('tambah_layanan');
    }

    public function tambah_data_layanan()
    {
        $input = (object) $this->input->post();
        $this->spkb->tambah_data_layanan($input);
    }

    public function edit_layanan()
    {
        $id = $this->input->get('id');
        $data['row'] = $this->spkb->get_layanan_detail($id);
        $this->load->view('edit_layanan', $data);
    }

    public function update_data_layanan()
    {
        $input = (object) $this->input->post();
        $this->spkb->update_data_layanan($input);
    }

    public function hapus_layanan()
    {
        $id = $this->input->post('id');
        $this->spkb->hapus_layanan($id);
    }

    public function hapus_pengguna()
    {
        $id = $this->input->post('id');
        $this->spkb->hapus_pengguna($id);
    }

    public function data_syarat_layanan()
    {
        $id = $this->input->get('id');
        $data['row'] = $this->spkb->get_layanan_detail($id);
        $data['list'] = $this->spkb->get_syarat_layanan_list($id);
        $this->load->view('data_syarat_layanan', $data);
    }

    public function tambah_syarat_layanan()
    {
        $id = $this->input->get('id');
        $data['row'] = $this->spkb->get_layanan_detail($id);
        $this->load->view('tambah_syarat_layanan', $data);
    }

    public function tambah_data_syarat_layanan()
    {
        $input = (object) $this->input->post();
        $this->spkb->tambah_data_syarat_layanan($input);
    }

    public function hapus_syarat_layanan()
    {
        $id = $this->input->post('id');
        $this->spkb->hapus_syarat_layanan($id);
    }

    public function edit_syarat_layanan()
    {
        $id = $this->input->get('id');
        $data['row'] = $this->spkb->get_syarat_layanan_detail($id);
        $this->load->view('edit_syarat_layanan', $data);
    }

    public function update_data_syarat_layanan()
    {
        $input = (object) $this->input->post();
        $this->spkb->update_data_syarat_layanan($input);
    }

    public function validasi_laporan()
    {
        $id = $this->input->post('id');
        $this->spkb->validasi_laporan($id);
    }

    public function data_laporan()
    {
        $data['list'] = $this->spkb->get_laporan_list();
        $this->load->view('data_laporan', $data);
    }

    public function data_pengguna()
    {
        $data['list'] = $this->spkb->get_pengguna_list();
        $this->load->view('data_pengguna', $data);
    }
}

/* End of file Main.php */
