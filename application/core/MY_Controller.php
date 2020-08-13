<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function index() {
        
    }

    public function checking()
    {
        $sesi_login = $this->session->logged_in;
        if ($sesi_login != true) {
            redirect('login','refresh');
        }
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
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

    public function push_breadcrumb($link = FALSE, $title = FALSE, $clean_start = FALSE) {
        $breadcrumb = [];
        $html = "";
        if ($clean_start == TRUE) {
            $this->session->set_userdata("breadcrumb", $breadcrumb);
        }
        if ($link != FALSE && $title != FALSE) {
            $param_string = explode("?", $link);
            $function_name = $param_string[0];
            $parameter = [];
            if (count($param_string) > 1) {
                $pair_list = explode("&", $param_string[1]);
                for ($i = 0; $i < count($pair_list); $i++) {
                    $pair = explode("=", $pair_list[$i]);
                    $parameter[$pair[0]] = $pair[1];
                }
            }
            $link = $function_name;
            $breadcrumb = $this->session->userdata("breadcrumb");
            if (!empty($breadcrumb)) {
                $index = array_search($link, array_column($breadcrumb, "link"));
                if ($index !== FALSE) {
                    $breadcrumb = array_splice($breadcrumb, 0, $index);
                }
            }
            $crumb = new stdClass();
            $crumb->link = $link;
            $crumb->title = $title;
            $crumb->parameter = $parameter;
            $breadcrumb == null ? $breadcrumb=[] : $breadcrumb;
            array_push($breadcrumb, $crumb);
            $this->session->set_userdata("breadcrumb", $breadcrumb);
            $html = $this->draw_breadcrumb();
        }
        return $html;
    }

    public function draw_breadcrumb() {
        $html = "";
        $html .= "<ol class='breadcrumb'><li><i class='fa fa-home'></i></li>";
        $breadcrumb = $this->session->userdata("breadcrumb");
        if ($breadcrumb !== FALSE && is_array($breadcrumb)) {
            foreach ($breadcrumb as $crumb) {
                if (count($crumb->parameter) > 0) {
                    $param_string = "?";
                    $separator = "";
                    foreach ($crumb->parameter as $key => $value) {
                        $param_string .= $separator . $key . "=" . $value;
                        $separator = "&";
                    }
                    $html .= "<li class='item-crumb' onclick='render(\"$crumb->link$param_string\")'>$crumb->title</li>";
                } else {
                    $html .= "<li class='item-crumb' onclick='render(\"$crumb->link\")'>$crumb->title</li>";
                }
            }
        }
        $html .= "</ol>";
        return $html;
    }
    
    public function go_back()
    {
        $breadcrumb = $this->session->userdata("breadcrumb");
        if (count($breadcrumb) > 1) {
            $crumb = $breadcrumb[count($breadcrumb) - 2];
            $function_name = $crumb->link;
            $parameter = $crumb->parameter;
            unset($_SESSION["breadcrumb"][count($breadcrumb) - 1]);
            $link = $function_name;
            $and = "?";
            $delimiter = "";
            if (count($parameter) > 0) {
                foreach ($parameter as $key => $value) {
                    $link .= $and.$delimiter.$key."=".$value;
                    $and = "";
                    $delimiter= "&";
                }
            }
        } else {
            $function_name = "dashboard";
            $parameter = [];
            $link = $function_name;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($link));
    }

    public function restrict_page()
    {
        $html = "<section class='content-header'></section>
        <section class='content'>
            <div class='error-404'>
                <div class='error-404-main'>Oops..!!</div>
                <h1>Page Not Found</h1>
                <p>Sorry, but the page you were trying to view does not exist or you havent access to this page.</p>
                <button onclick='renderLastPage()' class='btn bg-maroon' style='margin-top:10px'> Back to Home </button>
            </div>
        </section>";
        return $html;
    }

    public function auth_page($level = FALSE)
    {
        $sesi_login = $this->session->logged_in;
        $sesi_level = $this->session->level;
        if ($sesi_login != TRUE) {
            echo json_encode(["message" => "You dont have permission to do this action"]); 
            exit;
        } else {
            if ($level != FALSE) {
                if ($sesi_level >= $level) {
                    return;
                } else {
                    echo $this->restrict_page();
                    exit();
                }
            } else {
                return;
            }
        }
    }

}

/* End of file MY_Controller.php */
