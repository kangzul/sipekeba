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

    public function pdf_surat($id)
    {
        $this->load->library('Pdf');
        $data['data'] = $this->spkb->get_laporan_detail($id);
        $pdf = new TCPDF('P', 'cm', 'A4', true, "UTF-8", true);
        $pdf->SetTitle('Surat Kehilangan');
        $pdf->SetMargins(1, 0, 1);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetFont('times', '', 12);
        $pdf->AddPage();
        $html = $this->load->view('pdf_surat', $data, TRUE);
        $pdf->writeHTMLCell(0, 0, '', '', $html);
        $pdf->Output('SURAT_KEHILANGAN.pdf', 'I');
        exit();
    }

}

/* End of file Auth.php */
