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
                    'user_id' => $row->id_admin,
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

    public function hapus_pengguna($id)
    {
        $this->db->where('id_user', $id);
        $this->db->update('master_user', ['deleted_at' => date('Y-m-d H:i:s'), 'status' => 0]);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl hapus pengguna');
        } else {
            $this->swal('Gagal', 'error', 'Gagal hapus pengguna');
        }
    }

    public function validasi_laporan($id)
    {
        $this->db->where('id_laporan', $id);
        $this->db->update('master_laporan', ['status' => 2]);
        if ($this->db->affected_rows() > 0) {
            $this->swal('Berhasil', 'success', 'Berhasl validasi laporan');
        } else {
            $this->swal('Gagal', 'error', 'Gagal validasi laporan');
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

    public function get_list_layanan_all($id)
    {
        if ($id != 'all') {
            return $this->db->select('id as id_syarat, syarat')->get_where('master_syarat_layanan', ['deleted_at' => null, 'id_layanan' => $id, 'status' => 1])->result();
        }
        $this->db->select('id, nama_layanan, keterangan');
        $data = $this->db->get_where('master_layanan', ['deleted_at' => null, 'status' => 1])->result();
        foreach ($data as $key) {
            $key->list_syarat = $this->db->select('id as id_syarat, syarat')->get_where('master_syarat_layanan', ['deleted_at' => null, 'id_layanan' => $key->id, 'status' => 1])->result();
        }
        return $data;
    }

    public function check_upload($id)
    {
        $file_check = $this->check_upload_file("file", FALSE);
        if ($file_check->valid == TRUE) {
            $filename = str_replace("tmp_", "", $file_check->name);
            $this->do_upload_image("./uploads/", $filename);
            if ($this->upload->do_upload('file')) {
                $this->db->insert('rel_laporan', ['id_laporan' => $id, 'photo' => $filename, 'created_at' => date('Y-m-d H:i:s')]);
            } else {
                echo "Gagal Upload";
            }
        }
    }

    public function check_api_login($email, $pass)
    {
        $this->db->select('*')->from('master_user')->where(['email' => $email, 'status' => 1])->limit(1);
        $row = $this->db->get()->row();
        if ($row) {
            if (password_verify($pass, $row->password)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function check_api_signup($input)
    {
        $data = [
            'nama_lengkap'     => $input['nama'],
            'email'            => $input['email'],
            'password'         => password_hash($input['pass'], PASSWORD_DEFAULT),
            'jenis_kelamin'    => $input['gender'],
            'tempat_tgl_lahir' => $input['ttl'],
            'alamat'           => $input['alamat'],
            'kewarganegaraan'  => $input['warga'],
            'pekerjaan'        => $input['kerja'],
            'agama'            => $input['agama'],
            'status'           => 1,
            'created_at'       => date('Y-m-d H: i: s'),
        ];
        $this->db->insert('master_user', $data);
        if ($this->db->affected_rows() > 0) {
            $array = [
                'id_user' => $this->db->insert_id(),
            ];
            return $array;
        } else {
            return false;
        }
    }

    public function get_laporan_list()
    {
        $this->db->select('lap.*, u.nama_lengkap, lay.nama_layanan')->from('master_laporan lap')
            ->join('master_layanan lay', 'lap.id_layanan = lay.id')
            ->join('master_user u', 'lap.id_user = u.id_user')
            ->order_by('lap.id_laporan', 'desc');
        $data =  $this->db->get()->result();
        foreach ($data as $key) {
            $key->file = $this->db->get_where('rel_laporan', ['id_laporan' => $key->id_laporan])->result();
        }
        return $data;
    }

    public function buat_laporan($input)
    {
        $data = [
            'id_user'    => $input['id_user'],
            'id_layanan' => $input['layanan'],
            'alasan'     => $input['alasan'],
            'created_at' => date('Y-m-d H:i:s'),
            'status'     => 1,
        ];
        $this->db->insert('master_laporan', $data);
        if ($this->db->affected_rows() > 0) {
            $array = [
                'id_laporan' => $this->db->insert_id(),
            ];
            return $array;
        } else {
            return false;
        }
    }

    public function get_user_detail($id)
    {
        return $this->db->get_where('master_user', ['id_user' => $id])->row();
    }

    public function get_pengguna_list()
    {
        $this->db->order_by('id_user', 'desc');
        return $this->db->get_where('master_user', ['status' => 1])->result();
    }

    public function get_laporan_detail($id)
    {
        $this->db->select('l.alasan, l.created_at AS wkt_lapor, u.*')->from('master_laporan l')
            ->join('master_user u', 'l.id_user = u.id_user')
            ->where('l.id_laporan', $id);
        return $this->db->get()->row();
    }
}

/* End of file Sipekeba.php */
