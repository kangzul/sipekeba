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

    public function login_authentication($input)
    {
        $this->db->select('*')->from('master_admin')->where(['username' => $input['username'], 'status' => 1])->limit(1);
        $row = $this->db->get()->row();
        if ($row) {
            if (password_verify($input['password'], $row->password)) {
                $session = [
                    'user_id' => $row->id_user,
                    'real_name' => $row->real_name,
                    'logged_in' => true,
                ];
                $this->session->set_userdata($session);
                $this->swal('Sukses', 'success', 'Login Sukses, Tunggu Sebentar...');
            } else {
                $this->swal('Login Gagal', 'error', 'Password yang anda masukkan tidak sesuai');
            }
        } else {
            $this->swal('Login Gagal', 'error', 'Data Tidak Ditemukan');
        }
    }

    public function get_user_list()
    {
        return $this->db->get('master_admin')->result();
    }

    public function tambah_data_admin($input)
    {
        $data = [
            'username'   => $input->username,
            'real_name'  => $input->fullname,
            'email'      => $input->email,
            'password'   => password_hash($input->password, PASSWORD_DEFAULT),
            'status'     => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('master_admin', $data);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl tambah admin baru');
        } else {
            $this->swal('Gagal', 'error', 'Gagal tambah admin baru');
        }
    }

    public function get_layanan_list()
    {
        return $this->db->get_where('master_layanan', ['deleted_at' => null])->result();
    }

    public function tambah_data_layanan($input)
    {
        $data = [
            'nama_layanan' => strtoupper($input->nama_layanan),
            'keterangan'   => $input->keterangan,
            'status'       => $input->status,
            'created_at'   => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('master_layanan', $data);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl tambah layanan baru');
        } else {
            $this->swal('Gagal', 'error', 'Gagal tambah layanan baru');
        }
    }

    public function hapus_layanan($id)
    {
        $this->db->where('id', $id);
        $this->db->update('master_layanan', ['deleted_at' => date('Y-m-d H:i:s')]);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl hapus layanan');
        } else {
            $this->swal('Gagal', 'error', 'Gagal hapus layanan');
        }
    }

    public function get_layanan_detail($id)
    {
        return $this->db->get_where('master_layanan', ['id' => $id])->row();
    }

    public function update_data_layanan($input)
    {
        $data = [
            'nama_layanan' => strtoupper($input->nama_layanan),
            'keterangan'   => $input->keterangan,
            'status'       => $input->status,
        ];
        $this->db->where('id', $input->id);
        $this->db->update('master_layanan', $data);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl update layanan');
        } else {
            $this->swal('Gagal', 'error', 'Tidak ada perubahan data');
        }
    }

    public function get_syarat_layanan_list($id)
    {
        return $this->db->get_where('master_syarat_layanan', ['id_layanan' => $id, 'deleted_at' => null])->result();
    }

    public function tambah_data_syarat_layanan($input)
    {
        $data = [
            'id_layanan' => $input->id_layanan,
            'syarat'     => $input->nama_syarat,
            'keterangan' => $input->keterangan,
            'status'     => $input->status,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('master_syarat_layanan', $data);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl tambah syarat layanan baru');
        } else {
            $this->swal('Gagal', 'error', 'Gagal tambah syarat layanan baru');
        }
    }

    public function hapus_syarat_layanan($id)
    {
        $this->db->where('id', $id);
        $this->db->update('master_syarat_layanan', ['deleted_at' => date('Y-m-d H:i:s')]);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl hapus syarat layanan');
        } else {
            $this->swal('Gagal', 'error', 'Gagal hapus syarat layanan');
        }
    }

    public function get_syarat_layanan_detail($id)
    {
        $this->db->select('s.*, l.nama_layanan')->from('master_syarat_layanan s')->join('master_layanan l', 's.id_layanan = l.id')->where('s.id', $id);
        return $this->db->get()->row();
    }

    public function update_data_syarat_layanan($input)
    {
        $data = [
            'syarat'     => $input->nama_syarat,
            'keterangan' => $input->keterangan,
            'status'     => $input->status,
        ];
        $this->db->where('id', $input->id_syarat);
        $this->db->update('master_syarat_layanan', $data);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl update syarat layanan');
        } else {
            $this->swal('Gagal', 'error', 'Tidak ada perubahan data');
        }
    }

    public function get_list_layanan_all()
    {
        $this->db->select('id, nama_layanan, keterangan');
        $data = $this->db->get_where('master_layanan', ['deleted_at' => null, 'status' => 1])->result();
        foreach ($data as $key) {
            $key->list_syarat = $this->db->select('id as id_syarat, syarat')->get_where('master_syarat_layanan', ['deleted_at' => null, 'id_layanan' => $key->id, 'status' => 1])->result();
        }
        return $data;
    }
}

/* End of file Sipekeba.php */
