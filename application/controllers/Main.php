<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index()
    {
        $this->load->view('main');
    }

    public function login()
    {
        $this->load->view('login');
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
        $this->load->view('data_admin');
        
    }

}

/* End of file Main.php */
