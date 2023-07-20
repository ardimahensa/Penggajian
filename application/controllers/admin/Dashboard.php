<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('role_id') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
            redirect('login');
        }
    }
    public function index()
    {
        $pegawai = $this->db->query("SELECT * FROM users WHERE role_id = 2");
        $admin = $this->db->query("SELECT * FROM users WHERE role_id = 1");
        $jabatan = $this->db->query("SELECT * FROM positions");
        $kehadiran = $this->db->query("SELECT * FROM presences");
        $profile = $this->db->query("SELECT * FROM user_profiles");

        $data['title'] = "Dashboard";
        $data['pegawai'] = $pegawai->num_rows();
        $data['admin'] = $admin->num_rows();
        $data['jabatan'] = $jabatan->num_rows();
        $data['kehadiran'] = $kehadiran->num_rows();
        $data['profile'] = $profile->num_rows();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template_admin/footer', $data);
    }
}
