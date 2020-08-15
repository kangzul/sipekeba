<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    public function __construct()
    {
        $this->_authenticate_CORS();
        $this->__resTraitConstruct();
        $this->load->helper(['jwt']);
        $this->load->model('Sipekeba', 'spkb');
    }

    protected function _authenticate_CORS()
    {
        header('Access-Control-Allow-Origin: *');
        if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: ACCEPT, ORIGIN, X-REQUESTED-WITH, CONTENT-TYPE, AUTHORIZATION');
            header('Access-Control-Max-Age: 86400');
            header('Content-Length: 0');
            header('Content-Type: text/plain');
            exit;
        }
    }

    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');
        $check = $this->spkb->check_api_login($email, $password);
        if ($check) {
            $token = JWT::generateToken(['email' => $email, 'started_at' => date('YmdHis')]);
            $response = ['code' => 200, 'message' => 'Successful', 'data' => ['token' => $token]];
            $this->response($response, 200);
            return;
        }
        $this->response(['code' => 404, 'message' => 'Invalid username or password!'], 200);
    }

    public function list_layanan_post()
    {
        $this->verify_request();
        $layanan = $this->spkb->get_list_layanan_all();
        $this->response(['code' => 200, 'message' => 'Successful', 'data' => ['list' => $layanan]], 200);
    }

    private function verify_request()
    {
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers)) {
            $token = $headers['Authorization'];
            try {
                $data = JWT::validateToken($token);
                if ($data === false) {
                    $response = ['code' => 401, 'message' => 'Unauthorized Access!.'];
                    $this->response($response, 200);
                    exit();
                } else {
                    return $data;
                }
            } catch (Exception $e) {
                $response = ['code' => 401, 'message' => 'Unauthorized Access!'];
                $this->response($response, 200);
            }
        } else {
            $response = ['code' => 401, 'message' => 'Authorization Not Found'];
            $this->response($response, 200);
        }
    }

    public function token_get()
    {
        $token = JWT::generateToken(['started_at' => date('YmdHis'), 'public' => true]);
        $response = ['code' => 200, 'message' => 'Successful', 'data' => ['token' => $token]];
        $this->response($response, 200);
    }
}

/* End of file Api.php */
