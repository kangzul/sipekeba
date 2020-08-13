<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sipekeba extends MY_Model
{
    public function swal($title, $icon, $text)
    {
        $result = new stdClass();
        $result->title = $title;
        $result->icon = $icon;
        $result->text = $text;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function login_authentication()
    {
        $this->db->select('*')->from;
        
        $this->db->select('u.*,uc.control_name,ug.group_id,ug.group_name')->from('users u')
            ->join('user_controls uc', 'u.user_control = uc.control_id')
            ->join('user_groups ug', 'uc.group_id = ug.group_id')
            ->where('u.user_name', $input->username)
            ->where('u.is_deleted', 0);
        $query = $this->db->get();
        $data_user = $query->row();
        $count_user = $query->num_rows();
        if ($count_user > 0) {
            if (password_verify($input->password, $data_user->user_password)) {
                $session = [
                    'user_id'         => $data_user->user_id,
                    'user_name'       => $data_user->user_name,
                    'real_name'       => $data_user->user_full_name,
                    'level'           => $data_user->group_id,
                    'level_name'      => $data_user->group_name,
                    'control'         => $data_user->user_control,
                    'control_name'    => $data_user->control_name,
                    'logged_in'       => true,
                ];
                $this->db->update('users', ['last_login' => date('Y-m-d H:i:s')], ['user_id' => $data_user->user_id]);
                $this->session->set_userdata($session);
                $response->success = true;
                $response->message = "Please wait while loading..";
            } else {
                $response->message = "Incorrectly Password, Please Try Again or Forgot Password";
            }
        } else {
            $response->message = "User Data Not Found";
        }
        $this->makejson($response);
    }

    public function get_user_list()
    {
        return $this->db->get('master_users')->result();
    }

    public function tambah_data_admin($input)
    {
        $data = [
            'username'   => $input->username,
            'real_name'  => $input->fullname,
            'email'      => $input->email,
            'password'   => password_hash($input->password, PASSWORD_DEFAULT),
            'status'     => 1,
            'created_at' => date('Y-m-d H: i:s'),
        ];
        $this->db->insert('master_users', $data);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil','success', 'Berhasl tambah admin baru');
        } else {
            $this->swal('Gagal','error', 'Gagal tambah admin baru');
        }
    }
}

/* End of file Sipekeba.php */
