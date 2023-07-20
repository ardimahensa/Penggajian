<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('role_id') != '2') {
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
        $data['title'] = "Dashboard";
        $id = $this->session->userdata('id');
        $data['pegawai'] = $this->db->select('users.id,
        users.position_id,
        users.employe_status,
        user_profiles.id,
        user_profiles.user_id,
        user_profiles.full_name,
        user_profiles.nik,
        user_profiles.tanggal_masuk,
        user_profiles.gender,
        user_profiles.foto,
        positions.id,
        positions.name,
        positions.basic_salary,
        positions.t_jabatan,
        positions.t_transport,
        positions.uang_makan,
        positions.uang_lembur,
        presences.id,
        presences.user_id,
        presences.month_year,
        presences.hadir,
        presences.lembur,
        presences.um_lembur,
        presences.ts_lembur,')
            ->from('users')
            ->join('user_profiles', 'user_profiles.user_id=users.id')
            ->join('presences', 'presences.user_id=users.id')
            ->join('positions', 'positions.id=users.position_id')
            ->where('users.id', $id)
            ->get()->result();

        $this->load->view('template_pegawai/header', $data);
        $this->load->view('template_pegawai/sidebar');
        $this->load->view('pegawai/dashboard', $data);
        $this->load->view('template_pegawai/footer');
    }
}
