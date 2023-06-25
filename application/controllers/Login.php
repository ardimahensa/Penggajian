<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->ModelPenggajian->cek_login($username, $password);

            if (!$cek) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Username atau Password Salah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
                redirect('login');
            }
            $this->session->set_userdata('role_id', $cek->role_id);
            $this->session->set_userdata('id', $cek->id);
            $this->session->set_userdata('full_name', $cek->full_name);
            $this->session->set_userdata('nik', $cek->nik);
            $this->session->set_userdata('gender', $cek->gender);
            $this->session->set_userdata('foto', $cek->foto);

            switch ($cek->role_id) {
                case 1:redirect('admin/dashboard');
                    break;
                case 2:redirect('pegawai/dashboard');
                    break;
                default:
                    break;
            }

        }
    }
    public function _rules()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
