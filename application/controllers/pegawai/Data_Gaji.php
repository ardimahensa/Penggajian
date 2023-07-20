<?php

class Data_Gaji extends CI_Controller
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

        $data['title'] = "Data Gaji";
        $id = $this->session->userdata('id');
        $data['gaji'] = $this->db->select('users.id,
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
            ->join('presences', 'presences.user_id=users.id')
            ->join('positions', 'positions.id=users.position_id')
            ->join('user_profiles', 'user_profiles.user_id=users.id')
            ->where('users.id', $id)
            ->get()->result();

        $this->load->view('template_pegawai/header', $data);
        $this->load->view('template_pegawai/sidebar');
        $this->load->view('pegawai/data_gaji', $data);
        $this->load->view('template_pegawai/footer');
    }

    public function cetak_slip($id)
    {
        $data['title'] = 'Cetak Slip Gaji';
        $data['print_slip'] = $this->db->select('users.id,
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
        presences.ts_lembur')
            ->from('users')
            ->join('presences', 'presences.user_id=users.id')
            ->join('positions', 'positions.id=users.position_id')
            ->join('user_profiles', 'user_profiles.user_id=users.id')
            ->where('presences.id', $id)
            ->get()->result();
        // var_dump($data);
        // die;
        $this->load->view('template_pegawai/header', $data);
        $this->load->view('pegawai/cetak_slip_gaji', $data);
    }
}
