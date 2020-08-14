<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sipekeba', 'spkb');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function out()
    {
        session_destroy();
		redirect(base_url('login'), 'refresh');
    }

    public function process()
    {
        $input = $this->input->post();
        $this->spkb->login_authentication($input);
    }

}

/* End of file Auth.php */
