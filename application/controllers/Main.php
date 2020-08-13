<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sipekeba', 'spkb');
    }

    public function index()
    {
        $this->load->view('main');
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function authentication()
    {
        $input = $this->input->post();
        $this->spkb->login_authentication($input);
    }

    public function logout()
    {
        # code...
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

}

/* End of file Main.php */
