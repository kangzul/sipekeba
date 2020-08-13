<?php

defined('BASEPATH') OR exit('No direct script access allowed');
define("ALLOWED_UPLOAD_TYPE", "gif|jpg|jpeg|png");
define("MAX_UPLOAD_SIZE", 2048);

class MY_Model extends CI_Model {

    public function response()
    {
        $response = new stdClass();
        $response->success = FALSE;
        $response->message = "Unknown Failure, Please Contact Developer";
        $response->found = FALSE;
        return $response;
    }

    public function makejson($data)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function check_upload_file($field_name, $required = TRUE) {
        $response = new stdClass();
        $response->success = FALSE;
        $response->valid = FALSE;
        $response->uploaded = FALSE;
        if (isset($_FILES[$field_name])) {
            if (!empty($_FILES[$field_name]['name'])) {
                if (is_uploaded_file($_FILES[$field_name]['tmp_name'])) {
                    $response->success = TRUE;
                    $response->uploaded = TRUE;
                    $response->temp_name = $_FILES[$field_name]['tmp_name'];
                    $response->type = $_FILES[$field_name]['type'];
                    $response->name = $_FILES[$field_name]['name'];
                    $response->size = $_FILES[$field_name]['size'];
                    $response->extension = pathinfo($response->name, PATHINFO_EXTENSION);
                    $allowed = ALLOWED_UPLOAD_TYPE;
                    $allowed = explode("|", $allowed);
                    if (in_array($response->extension, $allowed)) {
                        $response->valid = TRUE;
                        $response->message = "File OK.";
                    } else {
                        $response->message = "Extension not allowed.";
                    }
                } else {
                    $response->message = "File upload failed.";
                }
            } else {
                if ($required == FALSE) {
                    $response->valid = TRUE;
                }
                $response->message = "No file uploaded.";
            }
        } else {
            $response->message = "Input field undefined.";
        }
        return $response;
    }

	public function do_upload_image($custom_path = FALSE, $new_file_name = FALSE, $overwrite = TRUE)
	{
		$config['allowed_types'] = ALLOWED_UPLOAD_TYPE;
        $config['max_size'] = MAX_UPLOAD_SIZE;
        if ($custom_path != FALSE) {
            if (is_string($custom_path)) {
                $config['upload_path'] = $custom_path;
            }
        } else {
            $config['upload_path'] = './uploads/';
        }
        if ($new_file_name != FALSE) {
            if (is_string($new_file_name)) {
                $config['file_name'] = $new_file_name;
            }
        }
        if ($overwrite == TRUE) {
            $config['overwrite'] = TRUE;
        }
		$this->load->library('upload', $config);
    }
    
    public function dataList($data)
    {
        // $col_order = $data['col_order'];
        $col_search = $data['col_search'];
        $order = $data['order'];
        $this->db->select($data['query']['select']);
        $this->db->from($data['query']['from']);
        if (isset($data['query']['join'])) {
            $join_count = count($data['query']['join']);
            if ($join_count > 0) {
                for ($i=0; $i < $join_count; $i++) { 
                    if (isset($data['query']['join'][$i]['type'])) {
                        $this->db->join($data['query']['join'][$i]['tbl'], $data['query']['join'][$i]['cond'], $data['query']['join'][$i]['type']);
                    } else {
                        $this->db->join($data['query']['join'][$i]['tbl'], $data['query']['join'][$i]['cond']);
                    }
                }
            }
        }
        if (isset($data['query']['where'])) {
            $this->db->where($data['query']['where']);
        }
        if (isset($data['query']['limit'])) {
            $this->db->limit($data['query']['limit']);
        }
        $i = 0;
        foreach ($col_search as $item) {
            if (isset($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($col_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        // if (isset($_POST['order'])) {
        //     $this->db->order_by($col_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } else 
        if (isset($order)) {
            $dataOrder = $order;
            $this->db->order_by(key($dataOrder), $dataOrder[key($dataOrder)]);
        }
    }

    public function get_datatables($data)
    {
        $this->dataList($data);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        return $this->db->get()->result();
    }

    public function count_filtered($data)
    {
        $this->dataList($data);
        return $this->db->get()->num_rows();
    }

    public function count_all($data)
    {
        $this->db->select('*');
        $this->db->from($data['query']['from']);
        if (isset($data['query']['join'])) {
            $join_count = count($data['query']['join']);
            if ($join_count > 0) {
                for ($i=0; $i < $join_count; $i++) { 
                    if (isset($data['query']['join'][$i]['type'])) {
                        $this->db->join($data['query']['join'][$i]['tbl'], $data['query']['join'][$i]['cond'], $data['query']['join'][$i]['type']);
                    } else {
                        $this->db->join($data['query']['join'][$i]['tbl'], $data['query']['join'][$i]['cond']);
                    }
                }
            }
        }
        if (isset($data['query']['where'])) {
            $this->db->where($data['query']['where']);
        }
        if (isset($data['query']['limit'])) {
            $this->db->limit($data['query']['limit']);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function datatables_output($dataTable, $data)
    {
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->count_all($dataTable),
            "recordsFiltered" => $this->count_filtered($dataTable),
            "data"            => $data,
        );
        $this->makejson($output);
    }

    public function crud_insert($table, $data)
    {
        $response = $this->response();
        $data['created_at']  = date('Y-m-d H:i:s');
        $data['created_by']  = $this->session->user_id;
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->message = "Successfully added data";
        } else {
            $response->message = "Failed to add data";
        }
        $this->makejson($response);
    }

    public function crud_update($table, $data, $key)
    {
        $response = $this->response();
        $data['updated_by']  = $this->session->user_id;
        $this->db->where($key);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->message = "Successfully Update data";
        } else {
            $response->message = "Failed to update data";
        }
        $this->makejson($response);
    }

    public function crud_soft_delete($table, $key, $id)
    {
        $response = $this->response();
        $data = [
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => $this->session->user_id,
        ];
        $this->db->where_in($key, explode(',', $id));
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->message = "Successfully deleted data";
        } else {
            $response->message = "Failed to delete data";
        }
        $this->makejson($response);
    }

    public function crud_hard_delete($table, $key, $id)
    {
        $response = $this->response();
        $this->db->where_in($key, explode(',', $id));
        $this->db->delete($table);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->message = "Successfully deleted data";
        } else {
            $response->message = "failed to delete data";
        }
        $this->makejson($response);
    }

    public function crud_restore_data($table, $key, $id)
    {
        $response = $this->response();
        $data = [
            'is_deleted' => 0,
            'restored_at' => date('Y-m-d H:i:s'),
            'restored_by' => $this->session->user_id,
        ];
        $this->db->where_in($key, explode(',', $id));
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            $response->success = true;
            $response->message = "Successfully restored data";
        } else {
            $response->message = "failed to restore data ";
        }
        $this->makejson($response);
    }

}

/* End of file MY_Model.php */
